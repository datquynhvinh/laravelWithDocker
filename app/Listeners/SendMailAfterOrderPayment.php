<?php

namespace App\Listeners;

use App\Events\OrderPayment;
use App\Mail\OrderPaymentEmail;
use Illuminate\Support\Facades\Mail;

class SendMailAfterOrderPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderPayment  $event
     * @return void
     */
    public function handle(OrderPayment $event)
    {
        $amount = $event->order->amount;
        $note = $event->order->note;

        $html = "<h1>You have an order to pay </h1>"
           . "<p>Amount: $amount</p>"
           . "<p>Note: $note</p>";

        Mail::send([], [], function ($message) use ($html) {
            $message->to('datlt.mor@gmail.com')
                ->subject('You have an order to pay')
                ->setBody($html, 'text/html');
        });
    }
}
