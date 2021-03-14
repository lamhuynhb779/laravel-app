<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Orders;
use App\Events\OrderShoppingCart;

class OrdersController extends Controller 
{
    /**
     * Ship the given order
     * 
     * @param int $orderId
     * @return Response
     */
    public function ship($orderId) 
    {
        $order = Orders::findOrFail($orderId);
        // Order shipment logic

        event(new OrderShoppingCart($order));

        return view('orders/ship');
    }
}