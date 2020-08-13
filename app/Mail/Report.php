<?php

namespace App\Mail;

use App\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Report extends Mailable
{
    use Queueable, SerializesModels;
    public $ad, $link, $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ad $ad, String $reason = null)
    {
        $this->ad = $ad;
        $this->link = route('admin.ad.index', ['id' => $ad->id]);
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.report')
            ->subject('Reporte del anuncio #'.$this->ad->id.' con nombre '.$this->ad->name)
            ->withAd($this->ad)->withLink($this->link)
            ->withReason($this->reason);
    }
}
