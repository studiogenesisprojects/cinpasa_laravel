<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecapchaValidateRequest;
use App\Mail\ProductFormSended;
use App\Models\Carousel;
use App\Models\Petition;
use App\Models\Product;
use App\Models\ProductLang;
use Illuminate\Support\Facades\Mail;

class PetitionController extends Controller
{
    public function store(RecapchaValidateRequest $request)
    {
        if(isset($request->company)){
            $company = $request->company;
        } else {
            $company = 'Particular';
        }

        $comentaris = '';

        if(isset($request->medidas)){
            $comentaris = 'Medidas: ' . $request->medidas;
        }

        if(isset($request->cantidades)){
            $comentaris = $comentaris . ' Cantidades: ' . $request->cantidades;
        }

        if(isset($request->comentaris)){
            $comentaris = $comentaris . ' Comentarios: ' . $request->comentaris;
        }

        if(isset($request->activity)){
            $comentaris = $comentaris . ' Actividad: ' . $request->activity;
        }

        if(isset($request->web)){
            $comentaris = $comentaris . ' Web: ' . $request->web;
        }

        $petition = Petition::create([
            'fullname' => $request->name,
            'company' => $company,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'country' => '-',
            'comment' => $comentaris,
            'origen' => $request->origen,
        ]);

        if ($request->productsIds) {
            $productsIds = json_decode($request->productsIds);
            foreach ($productsIds as $id) {
                $petition->petitionProducts()->create([
                    "product_id" => $id
                ]);
            }
        }

        $email_catalan_spanish = "ventas@cinpasa.com";
        // $email_others = "diego.agudoal@gmail.com";
        // $locale = $request->locale;
        // if ($locale == "es" || $locale == "ca") {
            Mail::to($email_catalan_spanish)->send(new ProductFormSended($petition));
        // } else {
        //     Mail::to($email_others)->send(new ProductFormSended($petition));
        // }

        $carousel = Carousel::where('section_id', 18)->where('active', 1)->where('main', 1)->first();
        return view('front.contact.form-ok', compact('petition', 'carousel', 'request'));
    }
}
