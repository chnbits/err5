<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Request $request, Article $article)
    {
        if (empty($request->keyword)){
            return back();
        }
        $articles = $article->search($request->keyword)
                            ->paginate(10);
        return view('pages.list.index',['lists'=>$articles]);
    }
}
