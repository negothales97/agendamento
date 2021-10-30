<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\PageRequest;
use App\Interfaces\PageRepositoryInterface;

class PageController extends BaseController
{
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->modelRepository = $pageRepository;
        $this->path = 'page';
    }

    public function update(PageRequest $request, $id)
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
