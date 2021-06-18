<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\Order\Services\OrderService;
use App\Domain\Order\Requests\OrderStoreRequest;

class OrderController extends Controller
{
    private $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(OrderStoreRequest $request)
    {
        $this->service->create($request->all('name', 'phone', 'organization'));

        return response()->json([
            'success' => true,
            'message' => __('alerts.backend.orders.created'),
        ]);
    }
}
