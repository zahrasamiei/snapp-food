<?php

namespace Database\Seeders;

use App\Models\IngredientRecipe;
use Illuminate\Database\Seeder;

class IngredientRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #fill data to IngredientRecipe table
        $data = [
            [
                "ingredient_id" => "1",
                "recipe_id" => "1",
            ],
            [
                "ingredient_id" => "2",
                "recipe_id" => "1",
            ],
            [
                "ingredient_id" => "3",
                "recipe_id" => "1",
            ],
            [
                "ingredient_id" => "4",
                "recipe_id" => "1",
            ],
            [
                "ingredient_id" => "5",
                "recipe_id" => "2",
            ],
            [
                "ingredient_id" => "6",
                "recipe_id" => "2",
            ],
            [
                "ingredient_id" => "7",
                "recipe_id" => "2",
            ],
            [
                "ingredient_id" => "8",
                "recipe_id" => "2",
            ],
            [
                "ingredient_id" => "3",
                "recipe_id" => "2",
            ],
            [
                "ingredient_id" => "12",
                "recipe_id" => "3",
            ],
            [
                "ingredient_id" => "13",
                "recipe_id" => "3",
            ],
            [
                "ingredient_id" => "15",
                "recipe_id" => "3",
            ],
            [
                "ingredient_id" => "14",
                "recipe_id" => "3",
            ],
            [
                "ingredient_id" => "16",
                "recipe_id" => "3",
            ],
            [
                "ingredient_id" => "9",
                "recipe_id" => "4",
            ],
            [
                "ingredient_id" => "8",
                "recipe_id" => "4",
            ],
            [
                "ingredient_id" => "10",
                "recipe_id" => "4",
            ],
            [
                "ingredient_id" => "11",
                "recipe_id" => "4",
            ],
        ];
        IngredientRecipe::insert($data);
        #end
    }
}
