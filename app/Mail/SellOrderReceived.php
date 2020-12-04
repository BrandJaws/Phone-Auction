<?php

namespace App\Mail;

use App\Models\SellOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellOrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $sellOrder;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sell_order_id)
    {
        $this->sellOrder = \App\Models\SellOrder::where('id', $sell_order_id)
                                                ->with('items.selectedDeviceModel', 'items.selectedNetworkCarrier', 'items.selectedQuote.device_state')
                                                ->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-sell-order', ["sellOrder" => $this->sellOrder]);
    }
}
