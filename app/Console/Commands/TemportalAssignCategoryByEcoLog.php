<?php

namespace App\Console\Commands;

use App\Models\Material;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class TemportalAssignCategoryByEcoLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assing-category-by-eco-logo {product?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Product $product = null)
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products_with_eco =  Product::whereHas('ecoLogos')->get();

        $cordonMateriaReciclableCategory = ProductCategory::find(47729);
        $cintaReciclabeCategory = ProductCategory::find(47731);
        $cordonBIOCategory = ProductCategory::find(47730);
        $cordonFIBRANATURALCategory = ProductCategory::find(47727);
        $cordonMATERIARECICLADACategory = ProductCategory::find(47728);

        foreach ($products_with_eco as $product) {
            if ($product->ecoLogos->contains(9)) {
                if (strpos(strtolower($product->name), 'cord') !== false) {
                    if (!$product->categories->contains($cordonMateriaReciclableCategory)) {
                        $product->categories()->attach($cordonMateriaReciclableCategory);
                        $this->alert($product->name);
                    };
                } elseif (strpos(strtolower($product->name), 'cint') !== false) {
                    if (!$product->categories->contains($cintaReciclabeCategory)) {
                        $product->categories()->attach($cintaReciclabeCategory);
                        $this->alert($product->name);
                    };
                }
            }
            if ($product->ecoLogos->contains(10)) {
                if (!$product->categories->contains($cordonFIBRANATURALCategory)) {
                    $product->categories()->attach($cordonFIBRANATURALCategory);
                    $this->alert($product->name);
                };
            }
            if ($product->ecoLogos->contains(8)) {
                if (!$product->categories->contains($cordonMATERIARECICLADACategory)) {
                    $product->categories()->attach($cordonMATERIARECICLADACategory);
                    $this->alert($product->name);
                };
            }
            if ($product->ecoLogos->contains(7)) {
                if (!$product->categories->contains($cordonBIOCategory)) {
                    $product->categories()->attach($cordonBIOCategory);
                    $this->alert($product->name);
                };
            }
        }

        //POR MATERIAL 

        $materialALGODON = Material::find(23580);
        $materialPAPEL = Material::find(23620);
        $materialSISAL = Material::find(23700);
        $materialCANAMO = Material::find(23705);
        $materialYUTE = Material::find(23735);
        $materialLINO = Material::find(48020);
        $materialYUTELATEX = Material::find(51803);
        $products = Product::whereHas('materials')->get();
        foreach ($products as $product) {
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
                    $this->alert($product->name);
                }
            }
        }
    }
}
