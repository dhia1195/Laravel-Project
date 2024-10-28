<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transportItineraire;

    public function __construct($transportItineraire)
    {
        $this->transportItineraire = $transportItineraire;
    }

    public function build()
    {
        return $this->view('transport_itineraire.hello')
                    ->with(['transportItineraire' => $this->transportItineraire]);
    }
}
