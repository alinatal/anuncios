<?php

namespace App\Mail;

use App\Ad;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdUserRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $action, $url, $ad, $user, $request_name;


        /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ad $ad, User $user, $action)
    {
        $this->action = $action;
        $this->ad = $ad;
        $this->user = $user;
        if($action == 'destroy'){
            $this->request_name = 'borrado';
        }
        else{
            $this->request_name = 'edición';
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = $this->ad->getURL($this->action);
        return $this->view('mails.ad-user-request')
            ->subject('Tu Solicitud de '.$this->request_name.' está pendiente')
            ->withLink($link)
            ->withAction($this->action)
            ->withAd($this->ad)
            ->withUser($this->user);
    }

}
