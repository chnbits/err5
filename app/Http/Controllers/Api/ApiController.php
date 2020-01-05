<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getcid(Request $request)
    {
        $pid = $request->get('q');
        return Category::where('parent_id',$pid)->get(['id', DB::raw('title as text')]);
    }
}
