<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Language;

class TranslatedModel extends Model
{

    protected $languageModel;
    protected $languageModelForeignKey;

    protected $langCodeIds = [
        "es" => 1,
        "ca" => 2,
        "en" => 3,
        "it" => 4,
        "fr" => 5,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function languages()
    {
        return $this->hasMany($this->languageModel);
    }

    /**
     * Devuelve el modelo de traducción
     * Con el idioma que le pasamos como parametro (puede ser String o id)
     * O con el idioma actual de la app()->getLocale()
     */
    public function lang($id = null)
    {

        if (!$id) {
            $relation =  $this->languages->where($this->languageModelForeignKey ?? 'language_id', $this->langCodeIds[app()->getLocale()])->first();
            if ($relation) {
                return $relation;
            } else {
                return new $this->languageModel;
            }
        }

        if (!array_key_exists($id, $this->langCodeIds) && !array_search($id, $this->langCodeIds)) {
            throw new \Exception("Codigo o id de idioma no encontrado");
        }

        if (gettype($id) == "string") {
            return $this->languages->where($this->languageModelForeignKey ??  'language_id', (int) $this->langCodeIds[$id])->first();
        }
        return $this->languages->where($this->languageModelForeignKey ?? 'language_id', $id)->first();
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->lang()->slug;
    }
}