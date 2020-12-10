<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCaracteristics;

class ChangeReferences extends Controller
{
    public function execute(){
        $products = Product::all();

        foreach($products as $product){
            $categories = $product->categories->pluck('id');
            foreach($product->references as $reference){
                $product_caracteristics = new ProductCaracteristics;
                $product_caracteristics->product_id = $product->id;
                $product_caracteristics->references = $reference->referencia;
                $product_caracteristics->bags = $reference->bolsas;
                $product_caracteristics->laces = $reference->cordones;
                $product_caracteristics->rapport = $reference->rapport;

                foreach($product->categories as $category) {
                    if($category->sup_product_category == 25338){
                        $product_caracteristics->width_diameter = $reference->diametro;
                    } else if($category->sup_product_category ==  47734){
                        $product_caracteristics->width = $reference->diametro;
                    }  else if($category->sup_product_category ==  47735){
                        $product_caracteristics->width_diameter = $reference->diametro;
                    }  else if($category->sup_product_category ==  47736){
                        $product_caracteristics->width = $reference->diametro;
                    }  else if($category->sup_product_category ==  47737){
                        $product_caracteristics->diameter = $reference->diametro;
                    }
                }

                $product_caracteristics->save();
            }
        }
    }
}
