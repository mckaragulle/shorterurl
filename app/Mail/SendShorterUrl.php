<?php

namespace App\Mail;

use App\Models\ShorterUrl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendShorterUrl extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $long_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ShorterUrl $shorter_url)
    {
        $this->long_url = $shorter_url->long_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.send_shorter_url');
    }
}
