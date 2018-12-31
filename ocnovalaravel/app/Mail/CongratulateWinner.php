<?php

namespace App\Mail;

use App\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CongratulateWinner extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;
    public $actionUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    /**
     * CongratulateWinner constructor.
     * @param Lead $lead
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
        $this->actionUrl = 'https://action-to-controller-here';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.congratulate-winner-content');
    }
}
