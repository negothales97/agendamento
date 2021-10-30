<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SpecialtyCategoryRequest;
use App\Interfaces\SpecialtyCategoryRepositoryInterface;

class SpecialtyCategoryController extends BaseController
{
    public function __construct(SpecialtyCategoryRepositoryInterface $specialtyRepository)
    {
        $this->modelRepository = $specialtyRepository;
        $this->path = 'specialty';
    }

    public function store(SpecialtyCategoryRequest $request)
    {
        try {
            $this->modelRepository->store($request->validated());
            return back()
                ->with('success', 'Dados adicionados com sucesso.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }
    public function update(SpecialtyCategoryRequest $request, $id)
    {
        try {
            $this->modelRepository->update($id, $request->validated());
            return back()
                ->with('success', 'Dados atualizados com sucesso.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }
}
