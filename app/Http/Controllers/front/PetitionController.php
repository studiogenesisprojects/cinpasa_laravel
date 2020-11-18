<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecapchaValidateRequest;
use App\Mail\ProductFormSended;
use App\Models\Petition;
use App\Models\Product;
use App\Models\ProductLang;
use Illuminate\Support\Facades\Mail;

class PetitionController extends Controller
{
    public function store(RecapchaValidateRequest $request)
    {

        $petition = Petition::create([
            'fullname' => $request->nom_surname,
            'company' => $request->company,
            'email' => $request->email,
            'phone_number' => $request->tel,
            'country' => $request->country,
            'comment' => $request->comment,
            'origen' => $request->origen,
        ]);

        if ($request->product_id) {
            $product = Product::find($request->product_id);
            if ($product) {
                $petition->petitionProducts()->create([
                    "product_id" => $product->id
                ]);
            }
        }
        if ($request->productsIds) {
            $productsIds = json_decode($request->productsIds);
            foreach ($productsIds as $id) {
                $petition->petitionProducts()->create([
                    "product_id" => $id
                ]);
            }
        }

        $email_catalan_spanish = "comercial@laindustrialalgodonera.com";
        $email_others = "liasa@laindustrialalgodonera.com";
        $locale = $request->locale;
        if ($locale == "es" || $locale == "ca") {
            Mail::to($email_catalan_spanish)->send(new ProductFormSended($petition));
        } else {
            Mail::to($email_others)->send(new ProductFormSended($petition));
        }
        $request->session()->flash('petition', $petition);
        return response()->json($request->global_origin ? $request->global_origin : $petition->origen);
    }
}
