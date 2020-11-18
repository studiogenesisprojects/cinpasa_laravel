<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageLine extends Model
{

    protected $table = "language_lines";

    protected $fillable = [
        "group", "key", "text"
    ];

    public static function filter($request)
    {

        // $str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
        //     return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        // }, $str);

        $str = json_encode($request['traduction']);
        $str = str_replace("\\", "\\\\\\", $str);
        $str = str_replace("\"", "", $str);

        if ($request['type']) {
            $registros = LanguageLine::where('text', 'like', '%' . $str . '%')->first();
        } else {
            $registros = LanguageLine::where('text', 'like', '%' . $str . '%')->get();
        }

        return $registros;
    }
}
