<?php

namespace App\Providers;

use App\Helpers\Ingredient\IngredientClass;
use Illuminate\Support\ServiceProvider;

class IngredientHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('ingredientclass',function(){
            return new IngredientClass();
        });
    }
}
