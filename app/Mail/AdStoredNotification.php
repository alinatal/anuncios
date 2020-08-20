<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdStoredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ad, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ad, $user)
    {
        $this->ad = $ad;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.ad-stored-notification')
            ->subject('Nuevo anuncio publicado en Anuncios Lucena')
    ;
    }
}
