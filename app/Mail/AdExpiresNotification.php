<?php

namespace App\Mail;

use App\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdExpiresNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $user_ad, $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_ad)
    {
        $this->user_ad = $user_ad;
        $ad = Ad::findOrFail($user_ad->id);
        $this->link = $ad->getURL('renovate');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.ad-expires-notification')
            ->subject('Su anuncio expirará en '.env("AD_EXPIRATION_DATE_NOTIFICATION").' días')
            ->withData($this->user_ad)
            ->withLink($this->link);
    }
}
