<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * @var UserService $userService
     */
    private $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * register new user
     *
     * @param RegisterRequest $request
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        #get only needed data
        $data = $request->only(
            [
                'name',
                'email',
                'password',
                'confirm_password'
            ]
        );
        #send response
        return $this->userService->register($data);
    }

    /**
     * login user
     *
     * @param LoginRequest $request
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        #get only needed data
        $data = $request->only(
            [
                'email',
                'password'
            ]
        );
        #send response
        return $this->userService->login($data);
    }

}
