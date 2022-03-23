<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #read data from json file and fill in Ingredient table
        Ingredient::insert(
            readJsonFile(
                public_path() . "/json/ingredients.json"
            )["ingredients"]
        );
        #end
    }
}
