<?php

namespace App\Console\Commands;

use App\Models\Material;
use App\Models\MaterialCategory;
use Illuminate\Console\Command;

class ExportOldMaterials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export-materials';

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
        Material::where('sup_material',  NULL)->get()->each(function ($materialCat, $index) {
            $mc = MaterialCategory::create([
                "id" => $materialCat->id,
                "order" => $index,
            ]);
            foreach ($materialCat->languages as $l) {
                $mc->languages()->create($l->toArray());
            }
        });

        Material::where('sup_material', '!=',  NULL)->get()->each(function ($material, $index) {
            $materialCat = MaterialCategory::find($material->sup_material);
            $materialCat->materials()->attach([
                "material_id" => $material->id
            ]);
        });
    }
}
