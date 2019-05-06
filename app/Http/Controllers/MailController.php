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

        $recipient = 'danny@example.com';

        Mail::to($recipient)->send(new OrderShipped($order));

        return 'Sent order ' . $order->id;*/

        /*$order = Order::findOrFail( rand(1,50) );
        SendOrderEmail::dispatch($order);

        return 'Dispatched order ' . $order->id;*/

        for ($i=0; $i<20; $i++) {
            $order = Order::findOrFail( rand(1,50) );

            if (rand(1, 3) > 1) {
                Log::info('Dispatched email order ' . $order->id);
                SendOrderEmail::dispatch($order)->onQueue('email');
            } else {
                Log::info('Dispatched sms order ' . $order->id);
                SendOrderEmail::dispatch($order)->onQueue('sms');
            }
        }

        return 'Dispatched orders';
    }
}
