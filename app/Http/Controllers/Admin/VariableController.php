<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\VariableRequest;
use App\Interfaces\VariableRepositoryInterface;
use Illuminate\Http\Request;

class VariableController extends BaseController
{
    public function __construct(VariableRepositoryInterface $variableRepository)
    {
        $this->modelRepository = $variableRepository;
        $this->path = 'variable';
    }

    public function update(VariableRequest $request, $id)
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
