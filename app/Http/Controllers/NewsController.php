<?php

namespace App\Http\Controllers;

use App\News;
use App\NewsRelatedNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('writer', 'categories', 'tags', 'relatedNews')->orderBy('id', 'DESC')->get();
        return response()->json($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = json_decode($request->news, true);
        $news = News::create($data);
        foreach ($data["languages"] as $language) {
            $news->languages()->create($language);
        }
        $news->categories()->sync($data["categories"]);
        $news->tags()->sync($data["tags"]);
        if (isset($data["relateds"])) {
            foreach ($data["relateds"] as $related) {
                NewsRelatedNews::create([
                    "related_news_id" => $related,
                    "news_id" => $news->id,
                ]);
            }
        }

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/noticias', $imageName);
            $news->update(["image" => $imageName]);
            //TODO generat thumbnail
        }

        return response()->json($news);
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            //TODO check if there is duplicated
            $request->file('image')->storeAs('public/noticias', $filename);
            $url = url('storage/noticias/' . $filename);
            return response()->json($url);
        }
        return response()->json('no image', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = json_decode($request->news, true);
        $news = News::findOrFail($id);
        $news->update($data);
        foreach ($data["languages"] as $language) {
            $news->lang($language["language_id"])->update($language);
        }
        $news->categories()->sync($data["categories"]);
        $news->tags()->sync($data["tags"]);

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/noticias', $imageName);
            $news->update(["image" => $imageName]);
            //TODO generat thumbnail
            //TODO remove old image,
        }

        return response()->json($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->categories()->sync([]);
        $news->tags()->sync([]);
        $news->languages()->delete();
        $news->delete();
    }

    public function removeNewsRelation($news_id, $relation_id)
    {
        $nr = NewsRelatedNews::where('news_id', $news_id)->where('related_news_id', $relation_id)
            ->firstOrFail();
        $nr->delete();
    }

    public function addNewsRelations(Request $request)
    {
        NewsRelatedNews::create($request->toArray());
    }
}
