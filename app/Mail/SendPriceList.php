<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Attachment;

class SendPriceList extends Mailable
{
    public $customer;
    public $filePath;

    public function __construct($customer, $filePath)
    {
        $this->customer = $customer;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject('Your Price List')
            ->view('emails.pricelist')
            ->attach($this->filePath); // direct public path
    }
}
