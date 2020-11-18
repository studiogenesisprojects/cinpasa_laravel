<?php

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductReference;
use App\Models\Language;
use App\Models\ProductLang;
use App\Models\ProductImage;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 21) as $index) {

            $product = Product::create([
                "active" => 1,
                "liasa_code" => $faker->name,
                "order" => $index,
                "category_id" => 2,
                "type_id" => rand(1, 4),
                "form_id" => rand(1, 4),
                "brided_id" => rand(1, 4),
            ]);

            $pImage = ProductImage::create([
                "path" => 'public/productos/test2.jpg',
                "product_id" => $product->id
            ]);

            $product->product_image_id = $pImage->id;
            $product->save();

            foreach (Language::all() as $language) {
                ProductLang::create([
                    "product_id" => $product->id,
                    "language_id" => $language->id,
                    "name" => $faker->name(2),
                    "lite_description" => $faker->text(100),
                    "description" => $faker->text,
                    "video" => $faker->text,
                    "slug" => $faker->slug,
                ]);
            }

            ProductReference::create([
                "referencia" => $faker->name,
                "diametro" => $faker->randomDigit,
            ]);

            $product->colorCategories()->sync(rand(1, 4));

            $product->labels()->sync(rand(1, 4));

            $product->applications()->sync(range(1, 17));
            $product->finisheds()->sync(range(1, 17));

            $product->materials()->sync(rand(1, 4));

            if ($index > 1) {
                $product->relateds()->sync([
                    $product->id - 1
                ]);
            }
        }
    }
}