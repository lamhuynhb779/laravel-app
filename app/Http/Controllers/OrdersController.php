<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Jobs\Orders\CreateOrderJob;
use App\Models\Orders;
use App\Events\OrderShoppingCart;

class OrdersController extends Controller
{

    public function store()
    {
        dispatch((new CreateOrderJob())->onQueue('createorder'));
        return response()->json([], 200);
    }

    /**
     * Ship the given order
     *
     * @param int $orderId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ship(int $orderId)
    {
        $order = Orders::findOrFail($orderId);
        // Order shipment logic

        event(new OrderShoppingCart($order));

        return view('orders/ship');
    }
}
