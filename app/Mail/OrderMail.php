<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Письмо из моего магазина')
            ->view('mail.order_mail', ['order' => $this->order, 'fullSum'=> $this->totalSum($this->order)]);
    }


    public function totalSum($order)
    {
        $sum = 0;
        foreach ($order->products as $product) {
            $sum += $product->pivot->price * $product->pivot->quantity;
        }

        return $sum;
    }
}
