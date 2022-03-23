<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

     /**
     * login
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function login($data)
    {
        return $this->userRepository->login($data);
    }

    /**
     * register
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function register($data)
    {
        return $this->userRepository->register($data);
    }
}
