<?php

use App\Models\BraidLang;
use App\Models\FormLang;
use App\Models\Language;
use Illuminate\Database\Seeder;

use App\Models\ProductType;
use App\Models\ProductBraided;
use App\Models\ProductForm;
use App\Models\ProductLabel;
use App\Models\ProductColor;
use App\Models\Material;
use App\Models\MaterialLang;
use App\Models\ProductCategory;
use App\Models\TypeLang;
use App\Models\ProductCategoryLang;
use App\Models\ProductColorLang;
use App\Models\ProductColorCategory;
use App\Models\ProductColorCategoryLang;
use App\Models\ProductColorsCategoriesRelated;

class ProductAuxSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(0, 4) as $index) {
            $type = ProductType::create([]);

            $form = ProductForm::create([]);

            $braid = ProductBraided::create([]);

            $material = Material::create([
                "order" => $index + 1,
                "sup_material" => $index == 0 ? null : 1
            ]);


            foreach (Language::all() as $language) {
                //tipos
                TypeLang::create([
                    "type_id" => $type->id,
                    "language_id" => $language->id,
                    "name" => $faker->name,
                    "description" => $faker->text,
                ]);

                //formas
                FormLang::create([
                    "form_id" => $form->id,
                    "language_id" => $language->id,
                    "name" => $faker->name,
                    "description" => $faker->text,
                ]);

                //trenzados
                BraidLang::create([
                    "product_braided_id" => $braid->id,
                    "language_id" => $language->id,
                    "name" => $faker->name,
                    "description" => $faker->text,
                ]);

                //materiales
                MaterialLang::create([
                    "material_id" => $material->id,
                    "language_id" => $language->id,
                    "name" => $faker->name,
                    "slug" => $faker->slug,
                    "description" => $faker->text,
                ]);
            }

            //tags
            ProductLabel::create([
                "name" => $faker->name,
                "description" => $faker->text,
            ]);

            //color categories

            foreach (range(0, 10) as $index) {
                $productColorCategory = ProductColorCategory::create();
                foreach (Language::all() as $lang) {
                    ProductColorCategoryLang::create([
                        "product_color_category_id" => $productColorCategory->id,
                        "language_id" => $lang->id,
                        "name" => $faker->name,
                        "description" => $faker->text
                    ]);
                }

                $color = ProductColor::create([
                    "pantone" => substr(str_shuffle("0123456789"), 0, 4),
                    "rgb_color" => $faker->rgbcolor,
                    "hex_color" => str_replace("#", "", $faker->hexcolor),
                    "active" => true,
                    "product_color_category_id" => $productColorCategory->id
                ]);

                ProductColorsCategoriesRelated::create([
                    "color_id" => $productColorCategory->id,
                    "color_category_id" => $productColorCategory->id,
                ]);

                foreach (Language::all() as $lang) {
                    ProductColorLang::create([
                        "language_id" => $lang['id'],
                        "product_color_id" => $color->id,
                        "name" => $faker->name,
                        "slug" => $faker->slug,
                        "description" => $faker->text,
                    ]);
                }
            }
        }

        foreach ([
            "cordones",
            "cintas-elásticas",
        ] as $i => $v) {
            $father = ProductCategory::create([
                'image' => 'img/agatha.jpg'
            ]);
            foreach (range(1, 5) as $langId) {
                ProductCategoryLang::create([
                    'slug' => $v . '' . $i . '-lang-' . $langId,
                    'name' => $v . ' ' . $i,
                    'description' => $faker->text,
                    'product_category_id' => $father->id,
                    'language_id' => $langId,
                ]);
            }

            foreach (range(1, 4) as $in) {
                $child = ProductCategory::create(['sup_product_category' => $father->id, 'image' => 'img/agatha.jpg']);
                foreach (range(1, 5) as $langId) {
                    ProductCategoryLang::create([
                        'slug' => $v . '-child-' . $in . '-lang-' . $langId,
                        'name' => $v . ' child ' . $in,
                        'description' => $faker->text,
                        'product_category_id' => $child->id,
                        'language_id' => $langId
                    ]);
                }
            }
        }
    }
}
