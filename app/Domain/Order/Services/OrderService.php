<?php

namespace App\Domain\Order\Services;

use Domain\Order\Entities\Order;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domain\Core\Interfaces\ServiceInterface;

/**
 * Class OrderService.
 * @author Azizbek Eshonaliyev <1996azizbekeshonaliyev@email.com>
 */
class OrderService implements ServiceInterface
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function findAll(array $filter)
    {
        $orders = $this->order;

        if (array_key_exists('status', $filter)) {
            $orders = $orders->status($filter['status']);
        }

        return $orders;
    }

    public function create(array $input)
    {
        return DB::transaction(function () use ($input) {
            $input['status'] = $this->order::STATUS_NEW;

            if ($order = Order::create($input)) {
                return $order;
            }

            throw new GeneralException(__('exceptions.backend.orders.create_error'));
        });
    }

    public function update(Order $order, array $input)
    {
        $input['updated_by'] = auth()->id();

        return DB::transaction(function () use ($order, $input) {
            if ($order->update($input)) {
                return $order->fresh();
            }

            throw new GeneralException(__('exceptions.backend.orders.update_error'));
        });
    }

    public function delete(Order $order)
    {
        return $order->delete();
    }
}
