<?php

namespace App\Repositories;

interface OrderInterface
{
    /**
     * create new order
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function create($data);

}
