<?php

namespace App\Services;

use  PagarMe\Client;

class PagarMeService
{
    protected $pagarMe;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('pagarme.api_key');
        $this->pagarMe = new Client($this->apiKey);
    }
    public function createCard(array $fields)
    {
        $data = [
            'number' => $fields['card_number'],
            'holder_name' => $fields['holder_name'],
            'expiration_date' => "{$fields['exp_month']}{$fields['exp_year']}",
            'cvv' => $fields['cvv'],
        ];
        $card = $this->pagarMe->cards()->create($data);

        return $card;
    }

    public function generateDataCard(array $fields, $card)
    {
        return [
            'last_number' => $card->last_digits,
            'exp_month' => $fields['exp_month'],
            'exp_year' => $fields['exp_year'],
            'holder_name' => $fields['holder_name'],
            'card_id' => $card->id,
            'customer_id' => auth()->id()
        ];
    }

    public function addCash(array $data)
    {
        $transaction = $this->pagarMe->transactions()->create([
            'amount' => $data['value'],
            'card_id' => $data['card_id'],
            'payment_method' => 'credit_card',
        ]);
        return $transaction;
    }
    public function createTransaction(array $data)
    {
        $payload = [
            'amount' => $data['value'],
            'card_id' => $data['card_id'],
            'payment_method' => $data['payment_method'],
            'split_rules' => [
                // Specialist
                [
                    'percentage' => (10000 - $data['percentage']) / 100,
                    'recipient_id' => $data['recipient_id'],
                    'charge_processing_fee' => true,
                ],
                // Avivare
                [
                    'percentage' => $data['percentage'] / 100,
                    'recipient_id' => config('pagarme.recipient_id'),
                    'charge_processing_fee' => false
                ],
            ]
        ];
        $transaction = $this->pagarMe->transactions()->create($payload);
        return $transaction;
    }
    public function createRecipient(array $data)
    {
        $bankAccount = $this->pagarMe->bankAccounts()->create([
            'bank_code' => $data['bank_code'],
            'agencia' => $data['agencia'],
            'agencia_dv' => $data['agencia_dv'],
            'conta' => $data['conta'],
            'conta_dv' => $data['conta_dv'],
            'document_number' => $data['document_number'],
            'legal_name' => $data['name']
        ]);
        $recipient = $this->pagarMe->recipients()->create([
            'bank_account_id' => $bankAccount->id,
        ]);
        return [
            'recipient_id' => $recipient->id,
            'bank_account_id' => $bankAccount->id
        ];
    }

    public function refund($transactionId, $amount)
    {
        return $this->pagarMe->transactions()->refund([
            'id' => $transactionId,
            'amount' => $amount
        ]);
    }

    public function getBalance($recipientId)
    {
        if ($recipientId) {
            return $this->pagarMe->recipients()->getBalance([
                'recipient_id' => $recipientId,
            ]);
        }
        return null;
    }

    public function getPayable($transactionId)
    {
        return $this->pagarMe->transactions()->listPayables([
            'id' => $transactionId
        ]);
    }

    public function transfer($recipientId, $amount)
    {
        if ($amount <= 0) {
            return null;
        }

        return $this->pagarMe->transfers()->create([
            'amount' => $amount,
            'recipient_id' => $recipientId
        ]);
    }
}