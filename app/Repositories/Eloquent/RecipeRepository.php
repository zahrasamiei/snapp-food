<?php

namespace App\Repositories\Eloquent;

use App\Models\Recipe;
use App\Repositories\RecipeInterface;
use App\Traits\ResponseApi;

class RecipeRepository implements RecipeInterface
{

    use ResponseApi;

    /**
     * @var Recipe $model
     */
    protected $model;

    /**
     * @var IngredientRepository $ingredientRepository
     */
    protected $ingredientRepository;

    /**
     *
     * @param Recipe $model
     */
    public function __construct(
        Recipe $model,
        IngredientRepository $ingredientRepository
    )
    {
        $this->model = $model;
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * get recipes id from a collection
     * @param $array
     * @return mixed
     */
    public function getRecipesId($array)
    {
        $id = [];
        foreach ($array as $datum) {
            if (!empty($datum->recipes)) {
                foreach ($datum->recipes as $item) {
                    if (!in_array($item->id, $id)){
                        $id[] = $item->id;
                    }
                }
            }
        }
        return $id;
    }

    /**
     * filter with input fields or default values
     * @param array $array
     * @return mixed
     */
    public function menuFilter($array = [])
    {
        return callResource(
            "MenuResource",
            $this->model->whereNotIn(
                'id',
                $this->getRecipesId(
                    $this->ingredientRepository->menuItems($array)
                )
            )->get()
        );
    }

    /**
     * show menu with input filters
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * show menu
     *
     */
    public function menu()
    {
        #send success api response
        $this->success(
            __("messages.successfullyMenuFound"),
            sortByBestBefore($this->menuFilter())
        );
    }

    /**
     * show menu with input filters
     * @param $data
     *
     */
    public function menuWithFilters($data)
    {
        #send success api response
        $this->success(
            __("messages.successfullyMenuFound"),
            sortByBestBefore($this->menuFilter($data))
        );
    }

}
