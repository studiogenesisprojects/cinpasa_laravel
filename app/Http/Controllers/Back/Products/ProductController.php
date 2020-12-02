<?php

namespace App\Http\Controllers\Back\Products;

use App\Exports\ExportProducts;
use App\Exports\ExportProductsApps;
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

class ProductController extends Controller
{

    public function index()
    {
        // Product::arreglarOrder();
        return view('back.products.index', ['products' => Product::all()]);
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
        ]);
    }

    public function store(RequestCategory $request)
    {
        $product = Product::create($request->all());

        ProductCaracteristics::create(array_merge($request->all(), ['product_id' => $product->id, "outlet" => isset($request->outlet)]));

        if ($request->galery_id) {
            $galery = ProductGalery::find($request->galery_id);
            if ($galery) {
                $galery->update([
                    "product_id" => $product->id
                ]);
            }
        }

        if ($request->hasFile('primary_image')) {
            $path = $request->file('primary_image')->storeAs('productos', $request->file('primary_image')->getClientOriginalName());
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
        $product->materials()->sync($request->materials);
        $product->categories()->sync($request->categories);
        $product->colorCategories()->sync($request->colors);

        $product->labels()->sync($request->labels);
        //
        // $product->relateds()->sync($request->relateds);

        $product->ecoLogos()->sync($request->ecos);
        $this->assignCategories($product);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
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
        $caracteristics = ProductCaracteristics::where('product_id', $id)->first();

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
            'labs' => $labs
        ]);
    }

    public function update(RequestCategory $request, $id)
    {
        $product = Product::findOrFail($id);

        $product_caracteristics = ProductCaracteristics::where('product_id', $product->id)->first();
        $product_caracteristics->update($request->all());

        foreach ($request->productLanguages as $language) {
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
            $path = $request->file('primary_image')->storeAs('productos', $request->file('primary_image')->getClientOriginalName());
            $image = $product->images()->create(['path' => $path,]);
            $product->update(['product_image_id' => $image->id]);
        }

        if ($request->images) {
            foreach ($request->images as $image) {
                $path = $image->storeAs('productos', $image->getClientOriginalName());
                $image = $product->images()->create(['path' => $path,]);
            }
        }

        $product->references()->sync($request->references);
        $product->labels()->sync($this->getOrder($request->labels));
        $product->materials()->sync($this->getOrder($request->materials));
        $product->colorCategories()->sync($this->getOrder($request->colors));
        $product->finisheds()->sync($this->getOrder($request->finisheds));
        $product->applications()->sync($this->getOrder($request->applications));
        // $product->relateds()->sync($this->getOrder($request->relateds));
        $product->categories()->sync($this->getOrder($request->categories));

        $product->ecoLogos()->sync($request->ecos);
        $product->update(array_merge($request->all(), ["active" => isset($request->active), "outlet" => isset($request->outlet)]));
        $this->assignCategories($product);

        return redirect()->back()->with(["success" => "Product actualizado correctamente"]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['product_image_id' => null]);
        $product->images()->delete();
        $product->delete();

        return response()->json("ok");
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
        $galery = ProductGalery::find($request->galery_id);

        if ($request->hasFile('image')) {

            $path = $request->file('image')->storeAs('productos', $request->file('image')->getClientOriginalName());

            if ($galery) {
                $image = ProductGaleryImage::create([
                    "path" => $path,
                    "product_galery_id" => $galery->id
                ]);
            } else {
                $galery = ProductGalery::create(['product_id' => $request->product_id]);
                $image = $galery->images()->create([
                    "image" => $path
                ]);
            }
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

            return response()->json($productGaleryImage);
        }

        return response()->json($galery);
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

    private function assignCategories(Product $product)
    {

        $cordonMateriaReciclableCategory = ProductCategory::find(47729);
        $cintaReciclabeCategory = ProductCategory::find(47731);
        $cordonBIOCategory = ProductCategory::find(47730);
        $cordonFIBRANATURALCategory = ProductCategory::find(47727);
        $cordonMATERIARECICLADACategory = ProductCategory::find(47728);
        if ($product->ecoLogos->contains(9)) {
            if (strpos(strtolower($product->name), 'cord') !== false) {


                if (!$product->categories->contains($cordonMateriaReciclableCategory)) {
                    $product->categories()->save($cordonMateriaReciclableCategory);
                };
            } elseif (strpos(strtolower($product->name), 'cint') !== false) {
                if (!$product->categories->contains($cintaReciclabeCategory)) {
                    $product->categories()->attach($cintaReciclabeCategory);
                };
            }
        }
        if ($product->ecoLogos->contains(10)) {
            if (!$product->categories->contains($cordonFIBRANATURALCategory)) {
                $product->categories()->save($cordonFIBRANATURALCategory);
            };
        }
        if ($product->ecoLogos->contains(8)) {

            if (!$product->categories->contains($cordonMATERIARECICLADACategory)) {
                $product->categories()->save($cordonMATERIARECICLADACategory);
            }
        }
        if ($product->ecoLogos->contains(7)) {
            if (!$product->categories->contains($cordonBIOCategory)) {
                $product->categories()->save($cordonBIOCategory);
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
    }
}
