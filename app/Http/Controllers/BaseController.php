<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BaseController extends Controller
{
    protected $path;
    protected $modelRepository;

    public function index(Request $request)
    {
        $resources = $this->modelRepository->paginate($request->all(), 20);
        return view("admin.pages.{$this->path}.index")
            ->with('resources', $resources);
    }

    public function create()
    {
        return view("admin.pages.{$this->path}.create");
    }

    public function edit($id)
    {
        $resource =  $this->modelRepository->findById($id);
        if ($resource === null) {
            return back()
                ->with('info', 'Dados não localizados');
        }
        return view("admin.pages.{$this->path}.edit")
            ->with('resource', $resource);
    }

    public function delete($id)
    {
        $this->modelRepository->delete($id);
        return back()
            ->with('success', 'Dados removidos com sucesso');
    }
}
