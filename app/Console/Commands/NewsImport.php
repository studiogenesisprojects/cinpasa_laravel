<?php

namespace App\Console\Commands;

use App\Models\Noticia;
use App\News;
use App\NewsLang;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:news';

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

        $langCodeIds = [
            "es" => 1,
            "ca" => 2,
            "en" => 3,
            "it" => 5,
            "fr" => 4,
        ];
        NewsLang::truncate();

        $news = DB::connection('importer')->table('wp_posts')
            ->select('*')
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->leftJoin('wp_icl_translations', 'wp_posts.ID', '=', 'wp_icl_translations.element_id')
            ->orderBy('ID')
            ->get();

        foreach ($news as $n) {

            $_news = News::find($n->trid);
            if (!$_news) {
                $_news = News::create([
                    "created_at" => $n->post_date,
                    "id" => $n->trid,
                    "image" => "",
                    "thumbnail" => "",
                    "active" => true,
                    "writer_id" => 1,
                ]);
                foreach ([1, 2, 3, 4, 5] as $lid) {
                    $_news->languages()->create(["language_id" => $lid, "active" => false]);
                }
            }

            $_news->lang($langCodeIds[$n->language_code])->update([
                "title" => $n->post_title,
                "content" => $n->post_content,
                "seo_title" => $n->post_title,
                "seo_description" => strip_tags($n->post_content),
                "slug" => Str::slug($n->post_title),
                "active" => true,
            ]);

            $alreadyExistingNews = Noticia::whereHas('languages', function ($q) use ($_news) {
                $q->where('titulo', $_news->title);
            })->where('activo', 1)->first();
            if ($alreadyExistingNews) {
                $_news->update([
                    "image" => $alreadyExistingNews->imagen_principal,
                    "thumbnail" => $alreadyExistingNews->imagen_principal,
                ]);
            }
        }
    }
}
