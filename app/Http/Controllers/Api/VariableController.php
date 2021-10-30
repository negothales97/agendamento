<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\VariableRepositoryInterface;
use Illuminate\Http\Request;

class VariableController extends Controller
{
    protected $variableRepository;

    public function __construct(VariableRepositoryInterface $variableRepository)
    {
        $this->modelRepository = $variableRepository;
    }
    public function show($id)
    {
        $variable = $this->modelRepository->findById($id);
        return response()->json([
            'variable' => $variable
        ]);
    }
}
