<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $modelRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->modelRepository = $postRepository;
    }
    public function paginate(Request $request)
    {
        $resources = $this->modelRepository->paginate($request->all());
        return response()->json([
            'posts' => $resources
        ]);
    }

    public function show($id)
    {
        $resource = $this->modelRepository->findById($id);
        return response()->json([
            'post' => $resource
        ]);
    }
}
