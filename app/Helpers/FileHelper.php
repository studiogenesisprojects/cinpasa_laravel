<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelper {
    const DEFAULT_CONFIG = [
        "saveModel" => true,
        "strRandomLength" => 20,
        "includePathToSavedFileName" => false,
    ];

    private $field;
    private $path;
    private $config;

    public function __construct(string $field, string $path, array $config = []) {
        $this->field = $field;
        $this->path = $path;
        $this->config = array_merge(self::DEFAULT_CONFIG, $config);
    }

    public function saveFile($file, $model) {
        if ($model->{$this->field}) {
            $oldFilePath = $this->path . '/' . $model->{$this->field};
            if (Storage::exists($oldFilePath)) {
                Storage::delete($oldFilePath);
            }
        }
    
        $randomString = Str::random($this->config['strRandomLength']);
        $extension = $file->getClientOriginalExtension();
        $filename = $randomString . '.' . $extension;
    
        $path = $file->storeAs($this->path, $filename);
        
        if($this->config['includePathToSavedFileName']) {
            $filename = $this->path . '/' . $filename;
        }
        
        $model->{$this->field} = $filename;

        if($this->config['saveModel']) {
            $model->save();
        }
        
    }
}