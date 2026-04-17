<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ReturnStatusMail extends Mailable
{
    public $returnNumber;
    public $status;
    public $items;
    public $refund;

    public function __construct($returnNumber, $status, $items, $refund)
    {
        $this->returnNumber = $returnNumber;
        $this->status = $status;
        $this->items = $items;
        $this->refund = $refund;
    }

    public function build()
    {
        return $this->subject('Return ' . ucfirst($this->status))
            ->view('emails.return-status');
    }
}
