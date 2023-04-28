<?php

namespace App\Http\Controllers\Back\Products;

use App\Exports\ExportProducts;
use App\Exports\ExportProductsApps;
use App\Exports\ExportProductsDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCategory;
use App\Models\Product;
use App\Models\Aplication;
use App\Models\EcoFriend;
use App\Models\ProductColor;
use App\Models\Finished;
use App\Models\Lab;
use App\Models\ProductCategory;
use App\Models\ProductLabel;
use App\Models\ProductReference;
use App\Models\ProductType;
use App\Models\ProductForm;
use App\Models\ProductBraided;
use App\Models\ProductLabelRelated;
use App\Models\Material;
use App\Models\Language;
use App\Models\ProductCaracteristics;
use App\Models\ProductLang;
use App\Models\ProductImage;
use App\Models\ProductColorCategory;
use App\Models\ProductGalery;
use App\Models\ProductGaleryImage;
use App\Models\ProductGaleryImageLang;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Log;
use Str;
use Illuminate\Support\Facades\DB;
use Redirect;

class ProductController extends Controller
{

    public function index()
    {
        // Product::arreglarOrder();
        return view('back.products.index', ['products' => Product::where('outlet', false)->get()]);
    }

    public function create()
    {
        ini_set('memory_limit', '-1');
        $colors = ProductColorCategory::where('active', 1)->get();
        $finishes = Finished::all();
        $applications = Aplication::all();
        $related = Product::all();
        $categories = ProductCategory::where('sup_product_category', '!=', null)->get();
        $tags = ProductLabel::all();
        $ecos = EcoFriend::all();

        //características
        $types = ProductType::where('active', true)->get();
        $shapes = ProductForm::all();
        $braids = ProductBraided::all();
        $materials = Material::all();
        $references = ProductReference::all();
        $labs = Lab::all();

        return view('back.products.create', [
            "categories" => $categories,
            "colors" => $colors,
            "applications" => $applications,
            "relateds" => $related,
            "tags" => $tags,
            "ecos" => $ecos,
            "finishes" => $finishes,
            //features
            "types" => $types,
            "shapes" => $shapes,
            "braids" => $braids,
            "materials" => $materials,
            "references" => $references,
            'languages' => Language::all(),
            'labs' => $labs
        ]);
    }

    public function store(Request $request)
    {
        $request->slug = Str::slug($request->slug);

        $validated = $request->validate([
            'productLanguages.*.name' => 'required|max:255',
            'productLanguages.*.slug' => 'required|unique:product_langs,slug|max:255',
            'productLanguages.*.lite_description' => 'max:160',
            'productLanguages.*.seo_title' => 'max:191',
            'categories' => 'required',
            'colors' => 'required',
            'finisheds' => 'required',
            'applications' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $productId = DB::table('products')->insertGetId(['active' => $request->active, 'liasa_code' => $request->liasa_code, 'video' => $request->video, 'outlet' => ($request->outlet == 'true')]);
            $product = Product::findOrFail($productId);

            if(isset($request->references2)){
                for($i = 0; $i < sizeOf($request->references2); $i++){
                    $product_caracteristic = new ProductCaracteristics;
                    $product_caracteristic->product_id = $product->id;
                    $product_caracteristic->references = $request->references2[$i];
                    $product_caracteristic->material_id = $request->material_id[$i];
                    $product_caracteristic->width = $request->width[$i];
                    $product_caracteristic->bags = $request->bags[$i];
                    $product_caracteristic->laces = $request->laces[$i];
                    $product_caracteristic->rapport = $request->rapport[$i];
                    $product_caracteristic->diameter = $request->diameter[$i];
                    $product_caracteristic->length = $request->length[$i];
                    $product_caracteristic->width_diameter = $request->width_diameter[$i];
                    $product_caracteristic->observations = $request->observations[$i];
                    $product_caracteristic->flecortin_head = $request->flecortin_head;
                    $product_caracteristic->flecortin_width = $request->flecortin_width;
                    $product_caracteristic->order = $request->order_car[$i];
                    if(isset($request->discount[$i])){
                        $product_caracteristic->discount = abs($request->discount[$i]);
                    } else {
                        $product_caracteristic->discount = null;
                    }
                    if(isset($request->stock[$i])){
                        $product_caracteristic->stock = $request->stock[$i];
                    } else {
                        $product_caracteristic->stock = null;
                    }
                    $product_caracteristic->save();
                }
            }

            if ($request->galery_id) {
                $galery = ProductGalery::find($request->galery_id);
                if ($galery) {
                    $galery->update([
                        "product_id" => $product->id
                    ]);
                }
            }

            if ($request->hasFile('primary_image')) {
                $path = $request->file('primary_image')->storeAs('public/productos', $request->file('primary_image')->getClientOriginalName());
                $image = $product->images()->create(['path' => $path,]);
                $product->update(['product_image_id' => $image->id]);
            }


            foreach ($request->productLanguages as $lang) {
                $lang["active"] = isset($lang["active"]);
                $product->languages()->create($lang);
            }

            //relación de referencias
            $product->references()->sync($request->references);

            $product->applications()->sync($request->applications);
            $product->finisheds()->sync($request->finisheds);
            $product->categories()->sync($request->categories);
            $product->colorCategories()->sync($request->colors);
            $product->labs()->sync($request->labs);

            $product->labels()->sync($request->labels);
            //
            // $product->relateds()->sync($request->relateds);

            $product->ecoLogos()->sync($request->ecos);
            $this->assignCategories($product);

            DB::commit();

            //Si es un producto de outlet
            $route = 'productos';
            if ($product->outlet){
                $route = 'outlet';
            }

            return redirect()->route($route . '.edit', $product->id)->with('success', 'Producto creado correctamente');

        } catch(\Exception $ex){
            DB::rollBack();
            Log::error($ex);

            $error = 'Se han producido errores al guardar el producto.';
        }

        return Redirect::back()->withInput()->with('error', $error);

    }

    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $products = Product::all();
        $colors = ProductColorCategory::where('active', 1)->get();
        $finishes = Finished::all();
        $applications = Aplication::all();
        $related = Product::all();
        $categories = ProductCategory::where('sup_product_category', '!=', null)->get();
        $tags = ProductLabel::all();
        $ecos = EcoFriend::all();
        $labs = Lab::all();

        //características
        $types = ProductType::where('active', true)->get();
        $shapes = ProductForm::all();
        $braids = ProductBraided::all();
        $materials = Material::all();
        $references = ProductReference::all();
        $languages = Language::all();
        $caracteristics = ProductCaracteristics::where('product_id', $id)->get();
        $selected_labs = $product->labs->pluck('id');

        return view('back.products.edit', [
            "product" => $product,
            "products" => $products,
            "categories" => $categories,
            "colors" => $colors,
            "applications" => $applications,
            "relateds" => $related,
            "tags" => $tags,
            "ecos" => $ecos,
            "finishes" => $finishes,
            //features
            "types" => $types,
            "shapes" => $shapes,
            "braids" => $braids,
            "materials" => $materials,
            "references" => $references,
            "languages" => $languages,
            "caracteristics" => $caracteristics,
            'labs' => $labs,
            'selected_labs' => $selected_labs
        ]);
    }

    public function update(RequestCategory $request, $id)
    {
        $validated = $request->validate([
            'productLanguages.*.name' => 'required|max:255',
            'productLanguages.*.slug' => 'required|max:255',
            'productLanguages.*.lite_description' => 'max:160',
            'productLanguages.*.seo_title' => 'max:191',
            'categories' => 'required',
            'colors' => 'required',
            'finisheds' => 'required',
            'applications' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $product = Product::findOrFail($id);

            $product->caracteristics()->delete();

            if(isset($request->references2)){
                for($i = 0; $i < sizeOf($request->references2); $i++){
                    $product_caracteristic = new ProductCaracteristics;
                    $product_caracteristic->product_id = $product->id;
                    $product_caracteristic->references = $request->references2[$i];
                    $product_caracteristic->material_id = $request->material_id[$i];
                    $product_caracteristic->width = $request->width[$i];
                    $product_caracteristic->bags = $request->bags[$i];
                    $product_caracteristic->laces = $request->laces[$i];
                    $product_caracteristic->rapport = $request->rapport[$i];
                    $product_caracteristic->diameter = $request->diameter[$i];
                    $product_caracteristic->length = $request->length[$i];
                    $product_caracteristic->width_diameter = $request->width_diameter[$i];
                    $product_caracteristic->observations = $request->observations[$i];
                    $product_caracteristic->flecortin_head = $request->flecortin_head;
                    $product_caracteristic->flecortin_width = $request->flecortin_width;
                    $product_caracteristic->order = $request->order_car[$i];
                    if(isset($request->discount[$i])){
                        $product_caracteristic->discount = abs($request->discount[$i]);
                    } else {
                        $product_caracteristic->discount = null;
                    }
                    if(isset($request->stock[$i])){
                        $product_caracteristic->stock = $request->stock[$i];
                    } else {
                        $product_caracteristic->stock = null;
                    }

                    $product_caracteristic->save();
                }
            }


            foreach ($request->productLanguages as $language) {
                $language['slug'] = Str::slug($language['slug']);
                $language["active"] = isset($language["active"]);
                $lang = $product->lang((int) $language['language_id']);
                if ($lang) {
                    $lang->update($language);
                } else {
                    $product->languages()->create($language);
                }

                if ($product->primaryImage) {
                    $lang = $product->primaryImage->lang((int) $language['language_id']);
                    if ($lang) {
                        $lang->update($language);
                    } else {
                        $product->primaryImage->languages()->create($language);
                    }
                }
            }


            if ($request->hasFile('primary_image')) {
                $path = $request->file('primary_image')->storeAs('public/productos', str_replace(" ","-",$request->file('primary_image')->getClientOriginalName()));
                $image = $product->images()->create(['path' => $path,]);
                $product->update(['product_image_id' => $image->id]);
            }

            if ($request->hasFile('list_image')) {

                $path = $request->file('list_image')->storeAs('public/productos', str_replace(" ","-",$request->file('list_image')->getClientOriginalName()));
                $image = $product->images()->create(['path' => $path,]);

                $product->list_image = $path;
                $product->save();
            }

            if ($request->images) {
                foreach ($request->images as $image) {
                    $path = $image->storeAs('public/productos', $image->getClientOriginalName());
                    $image = $product->images()->create(['path' => $path,]);
                }
            }

            $product->references()->sync($request->references);
            $product->labels()->sync($this->getOrder($request->labels));
            $product->colorCategories()->sync($this->getOrder($request->colors));
            $product->finisheds()->sync($this->getOrder($request->finisheds));
            $product->applications()->sync($this->getOrder($request->applications));
            // dd($request->labs);
            $product->labs()->sync($request->labs);
            // dd($product->applications);
            // $product->relateds()->sync($this->getOrder($request->relateds));
            $product->categories()->sync($this->getOrder($request->categories));

            $product->ecoLogos()->sync($request->ecos);
            $product->update(array_merge($request->all(), ["active" => isset($request->active), "outlet" => isset($request->outlet)?$request->outlet:false]));
            $this->assignCategories($product);

            DB::commit();

            return redirect()->back()->with(["success" => "Producto actualizado correctamente"]);

        } catch(\Exception $ex){
            DB::rollBack();
            Log::error($ex);

            $error = 'Se han producido errores al actualizar el producto.';
        }

        return Redirect::back()->withInput()->with('error', $error);

    }

    public function destroy($id)
    {

        try {

            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $product->caracteristics()->delete();

            foreach($product->galeries as $galery) {
                foreach($galery->images as $image){
                    $image->delete();
                }
                $galery->delete();
            }

            $product->galeries()->delete();
            $product->update(['product_image_id' => null]);
            $product->images()->delete();

            $product->languages()->delete();
            $product->references()->detach();
            $product->labels()->detach();
            $product->materials()->detach();
            $product->colorCategories()->detach();
            $product->finisheds()->detach();
            $product->applications()->detach();
            $product->labs()->detach();
            $product->categories()->detach();
            $product->ecoLogos()->detach();

            $product->delete();

            DB::commit();

            return response()->json("ok");

        } catch(\Exception $ex){
            DB::rollBack();
            Log::error($ex);

            return response()->json("error");
        }
    }

    public function order(Request $request)
    {
        foreach ($request->products as $i => $product) {
            $p = Product::find($product['id']);
            $p->update([
                'order' => $i
            ]);
            $this->repeatedOrder($p->order);
        }
        return response()->json($request->products);
    }

    private function repeatedOrder($order)
    {
        //Busco todos los que tienen el order que le he mandado
        $sameOrders = Product::where('order', $order)
            ->orderBy('updated_at', 'DESC')
            ->get();
        //si hay mas de uno pillo el segundo, le pongo de orden el siguiente numero y lo guardo
        if ($sameOrders->count() > 1) {
            $next = $sameOrders[1]->order + 1;
            $sameOrders[1]->update(['order' => $next]);

            //llamo otra vez a esta funcion con el número siguiente
            $this->repeatedOrder($next);
        }
    }

    public function deleteImage($id)
    {
        $productImage = ProductImage::findOrFail($id);
        if (Storage::exists($productImage->path)) {
            Storage::delete($productImage->path);
        }
        $productImage->delete();

        return response()->json('ok');
    }

    public function handleGalery(Request $request)
    {


        try {

            DB::beginTransaction();

            $galery = ProductGalery::find($request->galery_id);

            if ($request->hasFile('image')) {

                $path = $request->file('image')->storeAs('public/productos', $request->file('image')->getClientOriginalName());

                if ($galery) {
                    $image = ProductGaleryImage::create([
                        "path" => $path,
                        "product_galery_id" => $galery->id
                    ]);
                } else {
                    $galery = ProductGalery::create(['product_id' => $request->product_id]);
                    $image = ProductGaleryImage::create([
                        "path" => $path,
                        "product_galery_id" => $galery->id
                    ]);
                }
                DB::commit();
                return response()->json($image);

            } else {
                //update the translations for ProductGaleryimage
                if ($request->finished_galery_image_id) {
                    $productGaleryImage = ProductGaleryImage::findOrFail($request->finished_galery_image_id);
                    foreach ($request->languages as $language) {
                        $lang = $productGaleryImage->lang((int) $language['language_id']);

                        if ($lang) {
                            $lang->update($language);
                        } else {
                            $productGaleryImage->languages()->create($language);
                        }
                    }
                }

                DB::commit();

                return response()->json($productGaleryImage);
            }

            return response()->json($galery);

        } catch(\Exception $ex){
            DB::rollBack();
            Log::error($ex);

            return response()->json('error');
        }
    }

    public function deleteGalery($id)
    {
        $productGaleryImage = ProductGaleryImage::findOrFail($id);

        if (Storage::exists($productGaleryImage->image)) {
            Storage::delete($productGaleryImage->image);
        }

        $productGaleryImage->delete();
        return response()->json('ok');
    }

    private function getOrder($data)
    {
        if (!$data) return null;
        $orderedData = [];
        foreach ($data as $index => $data) {
            $orderedData[$data] = ["order" => $index + 1];
        }

        return $orderedData;
    }

    public function downloadExcel()
    {
        return Excel::download(new ExportProducts(), 'products.xls');
    }

    public function downloadExcelApps()
    {
        return Excel::download(new ExportProductsApps(), 'products.xls');
    }

    /**
     * Descarga un MS Excel con la información de los productos detallada
     */
    public function downloadExcelDetail()
    {
        return Excel::download(new ExportProductsDetail(), 'products.xls');
    }

    private function assignCategories(Product $product)
    {


        try {

            DB::beginTransaction();

            $cordonMateriaReciclableCategory = ProductCategory::find(47729);
            $cintaReciclabeCategory = ProductCategory::find(47731);
            $cordonBIOCategory = ProductCategory::find(47730);
            $cordonFIBRANATURALCategory = ProductCategory::find(47727);
            $cordonMATERIARECICLADACategory = ProductCategory::find(47728);
            if ($product->ecoLogos->contains(9)) {
                if (strpos(strtolower($product->name), 'cord') !== false) {


                    if (!$product->categories->contains($cordonMateriaReciclableCategory)) {
                        $product->categories()->attach($cordonMateriaReciclableCategory);
                    };
                } elseif (strpos(strtolower($product->name), 'cint') !== false) {
                    if (!$product->categories->contains($cintaReciclabeCategory)) {
                        $product->categories()->attach($cintaReciclabeCategory);
                    };
                }
            }
            if ($product->ecoLogos->contains(10)) {
                if (!$product->categories->contains($cordonFIBRANATURALCategory)) {
                    $product->categories()->attach($cordonFIBRANATURALCategory);
                };
            }
            if ($product->ecoLogos->contains(8)) {

                if (!$product->categories->contains($cordonMATERIARECICLADACategory)) {
                    $product->categories()->attach($cordonMATERIARECICLADACategory);
                }
            }
            if ($product->ecoLogos->contains(7)) {
                if (!$product->categories->contains($cordonBIOCategory)) {
                    $product->categories()->attach($cordonBIOCategory);
                };
            }

            //ASIGNAR SI ES de fibra natural
            $materialALGODON = Material::find(23580);
            $materialPAPEL = Material::find(23620);
            $materialSISAL = Material::find(23700);
            $materialCANAMO = Material::find(23705);
            $materialYUTE = Material::find(23735);
            $materialLINO = Material::find(48020);
            $materialYUTELATEX = Material::find(51803);
            if (
                $product->materials->contains($materialALGODON) ||
                $product->materials->contains($materialPAPEL) ||
                $product->materials->contains($materialSISAL) ||
                $product->materials->contains($materialCANAMO) ||
                $product->materials->contains($materialYUTE) ||
                $product->materials->contains($materialLINO) ||
                $product->materials->contains($materialYUTELATEX)
            ) {
                if (!$product->categories->contains($cordonFIBRANATURALCategory)) {
                    $product->categories()->attach($cordonFIBRANATURALCategory);
                }
            }

            DB::commit();

        } catch(\Exception $ex){
            DB::rollBack();
            Log::error($ex);
        }
    }
}
