<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Interfaces\PlaceRepositoryInterface;
use App\Services\PlaceService;
use Illuminate\Http\Request;

class PlaceController extends BaseController
{
    protected $placeService;

    public function __construct(PlaceRepositoryInterface $placeRepository, PlaceService $placeService)
    {
        $this->modelRepository = $placeRepository;
        $this->placeService = $placeService;
        $this->path = 'place';
    }

    public function store(PlaceRequest $placeRequest)
    {
        try {
            $data = $placeRequest->validated();
            $this->modelRepository->store($data);
            return back()
                ->with('success', 'Dados adicionados com sucesso.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }
    public function update(PlaceRequest $placeRequest, $id)
    {
        try {
            $this->modelRepository->update($id, $placeRequest->validated());
            return back()
                ->with('success', 'Dados atualizados com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }

    public function status($id)
    {
        try {
            $this->placeService->updateStatus($id);
            return back()
                ->with('success', 'Status atualizados com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }

    public function useOnline($id)
    {
        try {
            $this->placeService->updateOnline($id);
            return back()
                ->with('success', 'Dados atualizados com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }
}
