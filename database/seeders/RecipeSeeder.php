<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\IngredientRecipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #read data from json file and fill in Recipe table
        Recipe::insert(
            readJsonFile(
            public_path() . "/json/recipes.json"
            )
            ["recipes"]
        );
        #end
    }
}
