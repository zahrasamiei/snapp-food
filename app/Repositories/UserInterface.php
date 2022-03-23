<?php

namespace App\Repositories;

interface UserInterface
{
    /**
     * login
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function login($data);

    /**
     * register
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function register($data);

}
