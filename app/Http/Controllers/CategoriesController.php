<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show($id)
    {
        $cid_arr = Article::where('status','1')->get('cid')->pluck('cid')->toArray();
        $cid = in_array($id,$cid_arr)? 'cid':'pid';
        $cate_title = Category::where('status','1')->where('id',$id)->first();
//        dd($cate_title);
        $lists = Article::with('categories')->where('status','1')->where($cid,$id)->paginate(10);
        return view('pages.list.index',['lists'=>$lists,'cate_title'=>$cate_title]);
    }
}
