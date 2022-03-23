<?php

namespace App\Repositories\Eloquent;

use App\Models\Ingredient;
use App\Traits\ResponseApi;

class IngredientRepository
{

    use ResponseApi;

    /**
     * @var Ingredient $model
     */
    protected $model;

    /**
     * IngredientRepository constructor.
     *
     * @param Ingredient $model
     */
    public function __construct(Ingredient $model)
    {
        $this->model = $model;
    }

    /**
     * renew finished stocks based $newStock on each 15 minutes
     *
     * @param $newStock
     */

    public function renew($newStock)
    {
        #update stock for 0 stock
        $this->model->whereStock(0)->update([
            'stock' => $newStock
        ]);
    }

    /**
     * get expired or unavailable ingredients with recipes
     * @param array $array
     * @return mixed
     */

    public function menuItems($array = [])
    {
        #get expired or unavailable ingredients with recipes
        return $this->model
            ->where(
                'expires_at',
                $array["expires_at_operand"] ?? "<",
                $array["expires_at"] ?? date("Y-m-d")
            )
            ->orWhere(
                'stock',
                $array["stock_operand"] ?? "=",
                $array["stock"] ?? 0
            )
            ->with("recipes")
            ->get();
    }

}
