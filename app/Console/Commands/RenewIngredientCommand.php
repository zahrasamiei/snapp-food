<?php

namespace App\Console\Commands;

use App\Repositories\Eloquent\IngredientRepository;
use Illuminate\Console\Command;

class RenewIngredientCommand extends Command
{

    protected static $_STOCK = 4;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingredients:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'renew Ingredients';

    protected $ingredientRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IngredientRepository $ingredientRepository)
    {
        parent::__construct();

        #create object from ingredient repository for renew finished ingredients
        $this->ingredientRepository = $ingredientRepository;
        #end
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        #call renew method with new stock = $_STOCK
        $this->ingredientRepository->renew(
            self::$_STOCK
        );
        #end
    }
}
