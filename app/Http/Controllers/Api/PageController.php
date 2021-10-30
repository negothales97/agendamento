<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PageRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->modelRepository = $pageRepository;
    }
    public function index()
    {
        $pages = $this->modelRepository->getAll();
        return response()->json([
            'pages' => $pages
        ]);
    }
    public function show($id)
    {
        $page = $this->modelRepository->findById($id);
        return response()->json([
            'page' => $page
        ]);
    }
}
