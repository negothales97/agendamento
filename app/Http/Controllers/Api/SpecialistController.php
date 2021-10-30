<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\SpecialistRepositoryInterface;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    protected $modelRepository;

    public function __construct(SpecialistRepositoryInterface $specialistRepository)
    {
        $this->modelRepository = $specialistRepository;
    }
    public function paginate(Request $request)
    {
        $resources = $this->modelRepository->paginate($request->all());
        return response()->json([
            'specialists' => $resources
        ]);
    }

    public function show($id)
    {
        $resource = $this->modelRepository->findById($id);
        return response()->json([
            'specialist' => $resource
        ]);
    }
}
