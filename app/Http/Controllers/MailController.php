<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderEmail;
use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index() {

        /*$order = Order::findOrFail( rand(1,50) );

        $recipient = 'steven@example.com';

        Mail::to($recipient)->send(new OrderShipped($order));

        return 'Sent order ' . $order->id;*/

        $order = Order::findOrFail( rand(1,50) );
        SendOrderEmail::dispatch($order);

        Log::info('Dispatched order ' . $order->id);
        return 'Dispatched order ' . $order->id;
    }
}
