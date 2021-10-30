<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;

class PostController extends BaseController
{
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->modelRepository = $postRepository;
        $this->path = 'post';
    }

    public function store(PostRequest $request)
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
    public function update(PostRequest $request, $id)
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
