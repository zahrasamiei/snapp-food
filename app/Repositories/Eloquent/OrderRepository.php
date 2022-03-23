<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\OrderInterface;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderInterface
{

    use ResponseApi;

    /**
     * @var Order $model
     */
    protected $model;

    /**
     * @var RecipeRepository $recipeRepository
     */
    protected $recipeRepository;

    /**
     * OrderRepository constructor.
     *
     * @param Order $model
     * @param RecipeRepository $recipeRepository
     */
    public function __construct(
        Order $model,
        RecipeRepository $recipeRepository
    )
    {
        $this->model = $model;
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * create new order
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function create($data)
    {
        #if error happened rollback and remove database changes
        DB::beginTransaction();

        try{
            #get filled data
            $stock = $data["stock"];
            $recipe_id =$data["recipe_id"];
            #end

            #get recipe data
            $recipe = $this->recipeRepository->findById($recipe_id);
            #ingredients for recipe
            $ingredients = $recipe->ingredients;
            #get min stock in ingredients
            $minStock = minColumnInCollection($ingredients, "stock");

            #check stock exist for this recipe
            if ($stock > $minStock) {
                return $this->fail(
                    __("messages.notEnoughStock"),
                    404
                );
            }

            #create order
            $order = $this->model->create($data);

            #decrease ingredients stock
            $recipe->ingredients()->decrement("stock", $stock);

            #do changes to db
            DB::commit();
        }catch (\Exception $e) {
            #database rollback
            DB::rollBack();

            #send error api response
            return $this->fail(
                $e->getMessage(),
                500
            );
        }

        #send success api response
        return $this->success(
            __("messages.successfullyAdded"),
            $order
        );
    }

}
