<?php

namespace App\Services;

use App\Interfaces\ScheduleRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Mail\ScheduleConfirm;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Services\AgoraIoService;
use DateTime;
use Illuminate\Support\Facades\Mail;

class ScheduleService
{
    protected $scheduleRepository;
    protected $transactionRepository;
    protected $pagarMeService;
    protected $agoraIoService;
    protected $variables;

    public function __construct(
        ScheduleRepositoryInterface $scheduleRepository,
        TransactionRepositoryInterface $transactionRepository,
        PagarMeService $pagarMeService,
        AgoraIoService $agoraIoService
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->transactionRepository = $transactionRepository;
        $this->pagarMeService = $pagarMeService;
        $this->agoraIoService = $agoraIoService;
        $this->variables = DB::table('variables')->first();;
    }
    public function confirm(array $data, $id)
    {
        $schedule = $this->scheduleRepository->findById($id);


        $data += [
            'value' => $schedule->getAttributes()['price'],
            'percentage' => $this->variables->percentage,
            'recipient_id' => $schedule->specialist->recipient_id
        ];

        if ($schedule->status !== 1) {
            if ($data['payment_method'] == 'credit_card') {
                $transactionPagarMe = $this->pagarMeService->createTransaction($data);

                $transaction = $this->generateTransaction(
                    $transactionPagarMe,
                    $data['value'],
                    $data['percentage'],
                    $schedule
                );
                if ($transactionPagarMe->status == 'refused') {
                    return $transaction;
                }

                $schedule = $this->scheduleRepository->update($id, [
                    'status' => 1,
                    'transaction_status' => $transactionPagarMe->status,
                    'transaction_id' => $transactionPagarMe->id,
                    'customer_id' => auth()->id()
                ]);
                Mail::to($schedule->specialist->email)
                    ->send(new ScheduleConfirm($schedule));

                return $transaction;
            }
        }
        return null;
    }

    protected function generateTransaction($transactionPagarMe, $value, $percentage, $schedule)
    {
        $valueAvivare = $valueSpecialist = 0;
        if ($transactionPagarMe->status != 'refused') {
            $fee = $value * ($transactionPagarMe->cost / 1000);

            $valueSpecialist = $value * ((10000 - $percentage) / 10000) - $fee;
            $valueAvivare = $value * ($percentage / 10000);
        }
        if($transactionPagarMe->refunded_amount > 0 ){
            $description = 'Reembolso';
            $type = 'chargeback';
        }else{
            $description = 'Pagamento de agendamento';
            $type = 'charge';

        }

        return $this->transactionRepository->store([
            'transaction_id' => $transactionPagarMe->id,
            'transaction_status' => $transactionPagarMe->status,
            'value' => $value,
            'value_specialist' => $valueSpecialist,
            'value_avivare' => $valueAvivare,
            'type' => $type,
            'description' =>$description,
            'customer_id' => auth()->id(),
            'schedule_id' => $schedule->id,
            'specialist_id' => $schedule->specialist_id
        ]);
    }

    public function getSceduleTokenAgoraIo($id)
    {
        $schedule = $this->scheduleRepository->findById($id);
        if ($schedule->agoraio_token == null) {
            $channelName = md5("agendamento_{$schedule->id}_{$schedule->date}");

            $expireTimeInSeconds = 3600 * 3;
            $currentTimestamp = now()->getTimestamp();
            $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

            $token = $this->agoraIoService->generateToken($channelName, $privilegeExpiredTs);

            $schedule = $this->scheduleRepository->update($id, [
                'agoraio_token' => $token,
                'agoraio_channel' => $channelName,
            ]);
        }
        return $schedule;
    }

    public function valueRefund(int $id)
    {
        $schedule = $this->scheduleRepository->findById($id);
        $price = $this->getPriceChargeback($schedule);
        return [
            'credit_card' => formatIntegerToDecimal($price)
        ];
    }

    public function refund(int $id)
    {
        $schedule = $this->scheduleRepository->findById($id);
        $price = $this->getPriceChargeback($schedule);

            $transactionPagarMe = $this->pagarMeService->refund($schedule->transaction_id, $price);

            $transaction = $this->generateTransaction(
                $transactionPagarMe,
                $price,
                $this->variables->percentage,
                $schedule
            );

            $schedule = $this->scheduleRepository->update($id, [
                'customer_id' => null,
                'status' => 2
            ]);


        return [
            'schedule' =>$schedule,
            'transaction' =>$transaction,
        ];
    }

    public function getPriceChargeback($schedule)
    {

        $startDate = new DateTime(now());
        $endDate   = new DateTime($schedule->date);

        $dateDiff = ($startDate->diff($endDate)->days);

        $percentage = $this->getPercentageChargeBack($dateDiff);
        return $schedule->getAttributes()['price'] - ($schedule->getAttributes()['price'] *($percentage/10000));


    }

    protected function getPercentageChargeBack($dateDiff)
    {
        if($dateDiff > 30) {
            return $this->variables->chargeback_1;
        }
        if($dateDiff <= 30 && $dateDiff > 20){
            return $this->variables->chargeback_2;
        }
        if($dateDiff <= 20 && $dateDiff > 10){
            return $this->variables->chargeback_3;
        }
        if($dateDiff <= 10)
        {
            return $this->variables->chargeback_4;
        }
        return 0;

    }
}