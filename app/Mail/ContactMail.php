<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $ownerName = settingHelper('app_name', config('app.name'));
        return $this->from($this->data['email'])
                    ->subject($ownerName.' - New Contact Form Submission')
                    ->view('emails.contact')
                    ->with(['data' => $this->data]);
    }
}
