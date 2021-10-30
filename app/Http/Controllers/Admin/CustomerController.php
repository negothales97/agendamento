<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->modelRepository = $customerRepository;
        $this->path = 'customer';
    }

    public function store(CustomerRequest $request)
    {
        try {
            $this->modelRepository->store($request->all());
            return redirect()->route("admin.{$this->path}.index")
                ->with('success', 'Dados adicionados com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }
    public function update(CustomerRequest $request, $id)
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
