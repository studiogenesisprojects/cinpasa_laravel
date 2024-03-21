<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecapchaValidateRequest;
use App\Mail\ProductFormSended;
use App\Models\Carousel;
use App\Models\Petition;
use App\Models\Product;
use App\Models\ProductLang;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class PetitionController extends Controller
{
    public function store(RecapchaValidateRequest $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptchav3:submit,0.7',
            'fullname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
        ]);

        try {
            
            $company = $request->company;
            $comentaris = '';

            if(isset($request->distribute)){
                $comentaris = $comentaris.' '. __('Contacta.interest').': '.__('Distribuir.distribute').' ';
            }

            if(isset($request->presu)){
                if($request->presu == 'presupuesto'){
                    $comentaris = $comentaris.' '. __('Contacta.interest').': '.__('Contacta.recibir_presu').' ';
                }

                if($request->presu == 'info'){
                    $comentaris = $comentaris .' '. __('Contacta.interest').': '.__('Contacta.recibir_info').' ';
                }
            }

            if(isset($request->second)){
                switch($request->second){
                    case 'cantidades':
                        $comentaris = $comentaris . ' '.__('Contacta.cantidades').': '. $request->comentaris;
                        break;

                    case 'medidas':
                        $comentaris = $comentaris. ' '.__('Contacta.medidas').': ' . $request->comentaris;
                        break;

                    case 'comentarios':
                        $comentaris = $comentaris. $request->comentaris;
                }

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
                'country' => $request->country,
                'comment' => $comentaris,
                'origen' => $request->origen ?? 'contact',
            ]);

            if(!empty($request->productsIds)){
                foreach ($request->productsIds as $id) {
                    $petition->petitionProducts()->create([
                        "product_id" => $id
                    ]);
                }
            }

            if(env('APP_ENV') == 'production'){
                $email_catalan_spanish = "ventas@cinpasa.com";

            } else {
                $email_catalan_spanish = "montserrat.sistere@studiogenesis.es";
            }

            Mail::to($email_catalan_spanish)->send(new ProductFormSended($petition));

            // $locale = $request->locale;
            // if ($locale == "es" || $locale == "ca") {
            // } else {
            //     Mail::to($email_others)->send(new ProductFormSended($petition));
            // }

            $carousel = Carousel::where('section_id', 18)->where('active', 1)->where('main', 1)->first();
            $no_contact = true;
            $no_distribute = null;

            if($request->distribute == 'true'){
                $no_distribute = true;
            }

            return view('front.contact.form-ok', compact('petition', 'carousel', 'request', 'no_contact', 'no_distribute'));
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Error al enviar el formulario');   
        }
        
    }
}
