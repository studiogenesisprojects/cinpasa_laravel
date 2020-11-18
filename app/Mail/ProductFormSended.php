<?php

namespace App\Mail;

use App\Models\Petition;
use App\Models\Product;
use App\Models\ProductPetition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductFormSended extends Mailable
{
    use Queueable, SerializesModels;

    private $petition;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Petition $petition)
    {
        $this->petition = $petition;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Formulario Web')->view('mails.product_form')->with(
            ["petition" => $this->petition]
        );
    }
}
