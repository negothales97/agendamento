<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    protected $favoriteRepository;
    public function __construct(FavoriteRepositoryInterface $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }
    public function add($id)
    {
        $data = [
            'specialist_id' => $id,
            'customer_id' => auth()->id()
        ];
        $favorite = $this->favoriteRepository->updateOrCreate($data);
        return response()->json(['favorite' => $favorite]);
    }
    public function list()
    {
        $favorites = $this->favoriteRepository->findBy([
            'customer_id' => auth()->id(),
            'relationship' => true,
        ]);
        return response()->json(['favorites' => $favorites]);
    }
}
