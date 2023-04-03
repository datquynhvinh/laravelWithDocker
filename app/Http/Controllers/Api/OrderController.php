<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPayment;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create() {
        $createOrder = Order::create([
            'amount' => 12000,
            'note' => 'Order online',
        ]);

        // OrderPayment::dispatch($createOrder);

        return $createOrder;
    }
}
