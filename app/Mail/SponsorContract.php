<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SponsorContract extends Mailable
{
    use Queueable, SerializesModels;

    public $payment, $description, $web, $fullName, $address, $email, $phone, $city, $bankAccount, $cif;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->payment = ($data['payment_type'] == 'monthly') ? 'Mensual' : ($data['payment_type'] == 'biannual') ? 'semestral' : 'anual';
        $this->description = $data['description'];
        $this->web = $data['web'];
        $this->fullName = $data['full_name'];
        $this->address = $data['address'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->city = $data['city'];
        $this->bankAccount = $data['bank_account'];
        $this->cif = $data['cif'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.sponsor-contract')
            ->subject('Solicitud de contrato de publicidad de '.$this->fullName);
    }
}
