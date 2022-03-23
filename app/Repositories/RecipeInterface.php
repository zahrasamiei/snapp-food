<?php

namespace App\Repositories;

interface RecipeInterface
{
    /**
     * show menu
     *
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function menu();

    /**
     * show menu with input filters
     * @param $data
     *
     */
    public function menuWithFilters($data);
}
