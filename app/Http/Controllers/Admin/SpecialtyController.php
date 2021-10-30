<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SpecialtyRequest;
use App\Interfaces\SpecialtyRepositoryInterface;

class SpecialtyController extends BaseController
{
    public function __construct(SpecialtyRepositoryInterface $specialtyRepository)
    {
        $this->modelRepository = $specialtyRepository;
        $this->path = 'specialty';
    }

    public function store(SpecialtyRequest $request)
    {
        try {
            $this->modelRepository->store($request->validated());
            return redirect()->route("admin.{$this->path}.index")
                ->with('success', 'Dados adicionados com sucesso.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }
    public function update(SpecialtyRequest $request, $id)
    {
        try {
            $this->modelRepository->update($id, $request->validated());
            return redirect()->back()
                ->with('success', 'Dados atualizados com sucesso.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }
}
