<?php

namespace Webkul\Marketplace\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * New Order Mail class
 *
 * @author    Mohd Faheem <mohd.faheem268@webkul.com>
 * @copyright 2021 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class PaymentRequestCompleteNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $sellerOrder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sellerOrder,$seller)
    {
        $this->sellerOrder = $sellerOrder;
        
        $this->seller = $seller;

        $this->seller->name = $this->seller->customer->first_name.' '.$this->seller->customer->last_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->seller->customer->email,$this->seller->name)
            ->subject(trans('marketplace::app.mail.sales.paymentRequest.subject'))
            ->view('marketplace::emails.payment.paymentRequestdone',['sellerName'=> $this->seller->name]);
    }
}
