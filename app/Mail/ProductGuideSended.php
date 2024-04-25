<?php

namespace App\Mail;

use App\Models\product;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;
use Log;

class ProductGuideSended extends Mailable
{

    private $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('CINPASA | '. $this->product->name .' Guide')->view('mails.product_guide')->with(
            ["product" => $this->product]
        )
        ->attach(asset(Storage::url('public/productos/guia-tecnica/'.$this->product->technical_guide_file)));
    }
}
