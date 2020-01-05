<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PagesController extends Controller
{
    public function home()
    {
        $top_slider = Article::where('status','1')->where('is_slider','1')->first();
        $sliders = Article::with('categories')->offset(1)->where('status','1')->where('is_slider','1')->take(2)->get();
        $headlines = Article::with('categories')->where('status','1')->where('is_headline','1')->take(5)->get();
        $recommends = Article::with('categories')->where('status','1')->where('is_recommend','1')->take(4)->get();
        $lists = Article::with('categories')->where('status','1')->paginate(10);

        return view('pages.home.index',[
            'top_slider'=>$top_slider,
            'sliders'=>$sliders,
            'headlines'=>$headlines,
            'recommends'=>$recommends,
            'lists'=>$lists,
        ]);
    }
    public function about()
    {
        return view('pages.about.index');
    }
}
