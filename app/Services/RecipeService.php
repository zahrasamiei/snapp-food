<?php

namespace App\Services;

use App\Repositories\Eloquent\RecipeRepository;

class RecipeService
{
    /**
     * @var RecipeRepository
     */
    protected $recipeRepository;

    /**
     * RecipeService constructor.
     *
     * @param RecipeRepository $recipeRepository
     */
    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

     /**
     *  show menu
     *
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function menu()
    {
        #send recipe service response
        return $this->recipeRepository->menu();
    }

     /**
     *  show menu with input filters
     * @param $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function menuWithFilters($data)
    {
        #send recipe service response
        return $this->recipeRepository->menuWithFilters($data);
    }
}
