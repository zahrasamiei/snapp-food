<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\CreateOrderRequest;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{

    /**
     * @var OrderService $orderService
     */
    protected $orderService;

    /**
    * OrderController constructor.
    *
    * @param OrderService $orderService
    */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * craete new order
     *
     * @param CreateRequest $request
     * @return \App\Traits\Model|\Illuminate\Http\JsonResponse
     */
    public function create(CreateOrderRequest $request)
    {
        #get only needed data
        $data = $request->only([
            'recipe_id',
            'user_id',
            'stock'
        ]);
        #send response
        return $this->orderService->create($data);
    }
}
