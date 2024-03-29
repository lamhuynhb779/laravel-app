<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{

    public function index(){
//        return Article::all();
        $seconds = 60*60;
        return Cache::remember('articles', $seconds, function () {
            return Article::all();
        });
    }

    public function show($id){
        return Article::find($id);
    }

    public function store(Request $request){
        $article = Article::create($request->all());
        return response()->json($article, 201); // 201 - Created
    }

    public function update(Request $request, $id){
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return response()->json($article, 200); // 200 - OK success
    }

    public function delete(Article $article){
        $article->delete();
        return response()->json(null, 204);
    }
}
