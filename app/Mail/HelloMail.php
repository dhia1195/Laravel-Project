<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    public $serviceHebergement;

    public function __construct($serviceHebergement)
    {
        $this->serviceHebergement = $serviceHebergement;
    }

    public function build()
    {
        return $this->view('services_hebergement.hello')
                    ->with(['serviceHebergement' => $this->serviceHebergement]);
    }
}
