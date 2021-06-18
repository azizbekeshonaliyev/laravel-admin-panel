<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;
use Domain\Order\Entities\Order;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use App\Domain\Order\Services\OrderService;
use App\Domain\Order\Requests\OrderUpdateRequest;

class OrderController extends Controller
{
    private $service;

    private $view_location = 'backend.orders.';

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $orders = $this->service->findAll($request->all());

        $orders = $orders->latest()->paginate();

        return view($this->view_location.'index', [
            'orders' => $orders,
        ]);
    }

    public function create()
    {
        return view($this->view_location.'create');
    }

    public function show($id)
    {
        //
    }

    public function edit(Order $order)
    {
        return view($this->view_location.'edit', [
            'order' => $order,
        ]);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $this->service->update($order, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => __('alerts.backend.orders.updated')]);
    }

    public function destroy(order $order)
    {
        $this->service->delete($order);

        return new RedirectResponse(route('admin.orders.index'), ['flash_success' => __('alerts.backend.orders.deleted')]);
    }
}
