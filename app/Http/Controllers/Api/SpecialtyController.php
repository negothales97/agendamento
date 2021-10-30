<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\SpecialtyRepositoryInterface;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    protected $modelRepository;

    public function __construct(SpecialtyRepositoryInterface $specialtyRepository)
    {
        $this->modelRepository = $specialtyRepository;
    }
    public function getAll()
    {
        $resources = $this->modelRepository->getAll();
        return response()->json([
            'specialties' => $resources
        ]);
    }

    public function show($id)
    {
        $resource = $this->modelRepository->findById($id);
        return response()->json([
            'specialty' => $resource
        ]);
    }
}
