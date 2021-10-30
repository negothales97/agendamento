<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AdminRequest;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminController extends BaseController
{
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->modelRepository = $adminRepository;
        $this->path = 'admin';
    }

    public function create()
    {
        $roles = DB::table('roles')->select(['label', 'id'])->get();
        return view("admin.pages.{$this->path}.create")
            ->with('roles', $roles);
    }

    public function store(AdminRequest $request)
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

    public function edit($id)
    {
        $resource =  $this->modelRepository->findById($id);
        if ($resource === null) {
            return back()
                ->with('info', 'Dados não localizados');
        }
        $roles = DB::table('roles')->select(['label', 'id'])->get();

        return view("admin.pages.{$this->path}.edit")
            ->with('roles', $roles)
            ->with('resource', $resource);
    }

    public function update(AdminRequest $request, $id)
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
