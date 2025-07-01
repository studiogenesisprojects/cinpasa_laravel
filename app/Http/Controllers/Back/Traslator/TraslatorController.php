<?php

namespace App\Http\Controllers\Back\Traslator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\TranslationLoader\LanguageLine;
use App\Models\LanguageLine as LanguageLineFilter;
use App\Models\Language;
use App\Http\Requests\HandleUpdateTraslator;
use App\Models\Section;
use Exception;

class TraslatorController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.traducciones'));
    }
    
    public function index(Request $request)
    {
        $this->authorize('read', $this->section);
        if ($request->isMethod('post')) {

            if ($request->type) {

                $filter = LanguageLineFilter::filter($request->all());

                return redirect()->action('Back\Traslator\TraslatorController@update', ['slug' => $filter->group . '#' . $filter->key]);
            } else {
                $traslators = LanguageLineFilter::filter($request->all());
            }
        } else {
            $traslators = LanguageLine::groupby('group')->get();
        }

        return view('back.traslator.index', compact('traslators'));
    }

    public function update($slug)
    {
        $this->authorize('write', $this->section);
        $languages = Language::where('status', 1)->get();
        $line = LanguageLine::Where('group', '=', $slug)->get();
        return view('back.traslator.update', compact('languages', 'line', 'slug'));
    }

    public function handleTraducciones(Request $request, $slug)
    {
        $this->authorize('write', $this->section);
        $slug =  $request->slug;

        $traslators = LanguageLine::Where('group', '=', $slug)->get();

        foreach ($traslators as $key => $traslator) {

            $line_form = $request->textos[$traslator->key];
            $line = LanguageLine::Where('key', '=', $traslator->key)->Where('group', '=', $slug)->first();
            $data = [
                'group' => $slug,
                'key' => $traslator->key,
                'text' => $line_form,
            ];
            if (!$line) {
                LanguageLine::create($data);
                $messages = 'Campo creado correctamente.';
            } else {
                $line->update($data);
                $messages = 'Campo modificado correctamente.';
            }
        }
        return redirect()->action('Back\Traslator\TraslatorController@index')->with('messages', $messages);
    }

    public function newTranslate($slug = '')
    {
        $this->authorize('write', $this->section);
        $languages = Language::where('status', 1)->get();
        return view('back.traslator.create', compact('languages', 'slug'));
    }

    //crear desde 0 un grupo i texto
    public function handleUpdateCreate(HandleUpdateTraslator $request)
    {
        $this->authorize('write', $this->section);
        $request->validate([
            "key" => "required|string"
        ]);

        LanguageLine::create([
            'group' => $request->slug,
            'key' => $request->key,
            'text' => $request->textos
        ]);
        return redirect()->action('Back\Traslator\TraslatorController@index')->with('messages', 'Campo creado correctamente');
    }

    public function delete($slug)
    {
        $this->authorize('delete', $this->section);

        try {
            LanguageLine::Where('group', '=', $slug)->delete();
            return redirect()->action('Back\Traslator\TraslatorController@index')->with('messages', 'Traduccion eliminada.');
        } catch (Exception $e) {
            return redirect()->action('Back\Traslator\TraslatorController@index')->with('message', 'Error. No se puede eliminar la noticia.');
        }
    }
}
