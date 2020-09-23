<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new message instance.
     *
     * @param  array $data
     * @return void
     */
    public function __construct(array $data)
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
        return $this->markdown('mail-contact')
            ->from(env('MAIL_FROM_ADDRESS', 'tsprates@hotmail.com'))
            ->subject('Teste PHP')
            ->with($this->data);
    }
}
