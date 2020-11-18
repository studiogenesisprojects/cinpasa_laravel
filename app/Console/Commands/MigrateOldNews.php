<?php

namespace App\Console\Commands;

use App\Models\Noticia;
use App\News;
use Illuminate\Console\Command;

class MigrateOldNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:migrate-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate old news to the new module';

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
        $oldNews = Noticia::all();

        foreach ($oldNews as $old) {
            $news = News::create([
                "active" => $old->activo,
                "writer_id" => 1,
                "image" => $old->imagen_principal,
                "thumbnail" => $old->imagen_principal,
            ]);

            foreach ($old->noticiasLangs as $lanuguage) {
                if ($old->noticiaLang($lanuguage->idioma_id)) {
                    $newsLang = $news->languages()->create([
                        "title" => $lanuguage->titulo,
                        "language_id" => $lanuguage->idioma_id,
                        "slug" => $lanuguage->slug,
                        "subtitle" => $lanuguage->subtitulo,
                        "description" => $lanuguage->description,
                        "seo_title" => $lanuguage->title,
                        "seo_description" => $lanuguage->descripcion,
                        "content" => "",
                    ]);
                    $bloques = $old->noticiasBloques->where('idioma_id', $lanuguage->idioma_id);
                    foreach ($bloques as $oldBloc) {
                        $data = $oldBloc->getInfoBloqueFront();
                        if ($data) {
                            $newsLang->update([
                                "content" => $newsLang->content . $data->texto
                            ]);
                        }
                    }
                }
            }
        }
    }
}
