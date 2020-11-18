<?php

namespace App\Console\Commands;

use App\Models\AplicationLang;
use App\Models\ApplicationCategory;
use App\Models\ApplicationCategoryLang;
use App\Models\FinishedLang;
use App\Models\MaterialLang;
use App\Models\ProductCategoryLang;
use App\Models\ProductColorCategoryLang;
use App\Models\ProductLang;
use Illuminate\Console\Command;

class CopySeoDescriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo';

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
    public function __construct()
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
        //products 
        foreach (ProductLang::all() as $product_lang) {
            $product_lang->update([
                "seo_title" => $product_lang->name,
                "seo_description" => $product_lang->description
            ]);
        }

        foreach (MaterialLang::all() as $product_lang) {
            $product_lang->update([
                "seo_title" => $product_lang->name,
                "seo_description" => $product_lang->description
            ]);
        }

        foreach (ProductColorCategoryLang::all() as $product_lang) {
            $product_lang->update([
                "seo_title" => $product_lang->name,
                "seo_description" => $product_lang->description
            ]);
        }

        foreach (AplicationLang::all() as $product_lang) {
            $product_lang->update([
                "seo_title" => $product_lang->name,
                "seo_description" => $product_lang->description
            ]);
        }

        foreach (FinishedLang::all() as $product_lang) {
            $product_lang->update([
                "seo_title" => $product_lang->name,
                "seo_description" => $product_lang->large_description
            ]);
        }

        foreach (ApplicationCategoryLang::all() as $product_lang) {
            $product_lang->update([
                "seo_title" => $product_lang->name,
                "seo_description" => $product_lang->large_description
            ]);
        }

        foreach (ProductCategoryLang::all() as $product_lang) {
            $product_lang->update([
                "seo_title" => $product_lang->name,
                "seo_description" => $product_lang->description
            ]);
        }
    }
}
