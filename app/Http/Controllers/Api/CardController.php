<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Interfaces\CardRepositoryInterface;
use App\Services\PagarMeService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    protected $pagarMeService;
    protected $cardRepository;

    public function __construct(PagarMeService $pagarMeService, CardRepositoryInterface $cardRepository)
    {
        $this->pagarMeService = $pagarMeService;
        $this->cardRepository = $cardRepository;
    }

    public function list()
    {
        $cards = $this->cardRepository->findBy([
            'customer_id' => auth()->id()
        ]);
        return response()
            ->json(['cards' => $cards]);
    }
    public function store(CardRequest $cardRequest)
    {
        $cardPagarMe = $this->pagarMeService->createCard($cardRequest->all());
        $cardData = $this->pagarMeService->generateDataCard($cardRequest->all(), $cardPagarMe);
        $card =  $this->cardRepository->store($cardData);
        return response()
            ->json(['card' => $card]);
    }

    public function delete($id)
    {
        $this->cardRepository->delete($id);
        return response()
            ->json([]);
    }
}
