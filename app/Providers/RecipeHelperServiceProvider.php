<?php

namespace App\Providers;

use App\Helpers\Recipe\RecipeClass;
use Illuminate\Support\ServiceProvider;

class RecipeHelperServiceProvider extends ServiceProvider
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
        $this->app->bind('recipeclass',function(){
            return new RecipeClass();
        });
    }
}
