<?php

namespace App\Http\Controllers;

use App\Events\ArticleViewCount;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{
    public function show(Article $article)
    {
        event(new ArticleViewCount($article));

        $contents = Article::with('categories')->where('id',$article->id)->first();
        $cate_title =Category::where('id',$contents->categories->parent_id)->get()->all();

        return view('pages.content.index',['contents'=>$contents,'cate_title'=>$cate_title[0]]);
    }
}
