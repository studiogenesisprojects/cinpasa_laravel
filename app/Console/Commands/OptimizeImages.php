<?php

namespace App\Console\Commands;

use App\Models\Aplication;
use App\Models\ApplicationCategory;
use App\Models\Customer;
use App\News;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize-images';

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
        // $optimizerChain = OptimizerChainFactory::create();

        // foreach(Storage::directories() as $dir){
        //     foreach(Storage::allFiles($dir) as $file){
        //         $optimizerChain->optimize(storage_path('app/public/'.$file));

        //     }
        // }

        //optimie new 
        $applications = ApplicationCategory::all();


        foreach($applications as $n){
            if($n->list_image){
                try{
                    $origin = storage_path("app/public/".$n->list_image);
                    if(file_exists($origin)){
                        $name =str_replace(".jpg", "", $n->list_image)."_.jpg";
                        Image::make($origin)->resize(401, null, function($c){
                            $c->aspectRatio();
                        })->save(storage_path("app/public/".$name), 80);
                        $n->list_image = $name;
                        $n->save();
                    }else{
                        throw new Exception("no existe");
                    }
                   
                }catch(Exception $e){
                    $this->error($e->getMessage());
                    $this->error("no se ha podido redimensionar: ".storage_path("app/public/".$n->image));
                }
            }
            
        }
    }
}
