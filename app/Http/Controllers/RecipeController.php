<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuFilterRequest;
use App\Services\RecipeService;

class RecipeController extends Controller
{

    /**
     * @var RecipeService $recipeService
     */
    protected $recipeService;

    /**
     * RecipeController constructor.
     *
     * @param RecipeService $recipeService
     */
    public function __construct(RecipeService $recipeService)
    {
        #create object from recipe service
        $this->recipeService = $recipeService;
    }

    /**
     * show menu for available foods
     *
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function menu()
    {
        #send recipe service response
        return $this->recipeService->menu();
    }

    /**
     * show menu for available foods
     *
     * @var MenuFilterRequest $menuFilterRequest
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function menuWithFilters(MenuFilterRequest $menuFilterRequest)
    {
        #get only needed data
        $data = $menuFilterRequest->only([
            "expires_at_operand",
            "stock_operand",
            "expires_at",
            "stock",
            "order_column",
            "order_dir",
        ]);
        #send recipe service response
        return $this->recipeService->menuWithFilters($data);
    }
}
