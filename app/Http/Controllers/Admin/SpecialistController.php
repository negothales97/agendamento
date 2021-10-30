<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SpecialistRequest;
use App\Interfaces\SpecialistRepositoryInterface;
use App\Interfaces\SpecialtyCategoryRepositoryInterface;
use App\Services\PagarMeService;
use Illuminate\Support\Facades\Crypt;

class SpecialistController extends BaseController
{
    protected $specialtyCategoryRepository;
    protected $pagarMeService;
    public function __construct(SpecialistRepositoryInterface $specialistRepository, SpecialtyCategoryRepositoryInterface $specialtyCategoryRepository, PagarMeService $pagarMeService)
    {
        $this->modelRepository = $specialistRepository;
        $this->specialtyCategoryRepository = $specialtyCategoryRepository;
        $this->pagarMeService = $pagarMeService;
        $this->path = 'specialist';
    }

    public function create()
    {
        $categories = $this->specialtyCategoryRepository->getAll();
        return view("admin.pages.{$this->path}.create")
            ->with('categories', $categories);
    }

    public function store(SpecialistRequest $request)
    {
        $recipientData = $this->pagarMeService->createRecipient($request->all());
        $data = $request->all() + $recipientData;
        $this->modelRepository->store($data);
        try {
            return redirect()->route("admin.{$this->path}.index")
                ->with('success', 'Dados adicionados com sucesso.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()
                ->with('error', 'Tivemos um problema no servidor, entre em contato com um administrador.');
        }
    }

    public function edit($id)
    {
        $categories = $this->specialtyCategoryRepository->getAll();
        $resource =  $this->modelRepository->findById($id);

        return view("admin.pages.{$this->path}.edit")
            ->with('categories', $categories)
            ->with('resource', $resource);
    }

    public function update(SpecialistRequest $request, $id)
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
