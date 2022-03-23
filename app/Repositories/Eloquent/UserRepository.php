<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment;
use App\Models\User;
use App\Repositories\PaymentInterface;
use App\Repositories\UserInterface;
use App\Services\PaymentService;
use App\Traits\Validation;
use App\Traits\ResponseApi;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{

    use ResponseApi;

    /**
     * @var User $model
     */
    protected $model;

    /**
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    /**
     * register
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function register($data)
    {
        #crypt password
        $data["password"] = bcrypt($data["password"]);
        #create data
        $user = $this->model->create($data);
        #create token
        $accessToken = $user->createToken('Registered')->accessToken;
        #send response
        return $this->success(
            __("messages.successfullyUserCreate"),
            [
                "user" => $user,
                "token" => $accessToken
            ],
            200
        );
        #end
    }

    /**
     * login
     *
     * @param array $data
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function login($data)
    {
        #login
        if (Auth::attempt($data)) {
            $user=Auth::user();
            #create token
            $accessToken = $user->createToken('authToken')->accessToken;
            #send response
            return $this->success(
                __("messages.successfullyUserLogin"),
                [
                    "user" => $user,
                    "token" => $accessToken
                ]
            );

        }
        #end
        #send response
        return $this->fail(
            __("messages.errorUserLogin"),
            401
        );
    }

}
