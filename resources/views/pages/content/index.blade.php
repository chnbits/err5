@extends('layouts.app')
@section('title',isset($contents) ? $contents->title : '内容页')

@section('content')
    <nav aria-label="breadcrumb" class="my-2">
        <ol class="breadcrumb bg-white shadow">
            <li class="breadcrumb-item"><a href="/">首页</a></li>
            <li class="breadcrumb-item"><a href="/cates/{{$contents->categories->parent_id}}">{{$cate_title->title}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$contents->categories->title}}</li>
        </ol>
    </nav>
    <div class="row mb-5">
        <div class="col-9 mt-1 px-1">
            <div class="jumbotron bg-white border shadow py-4">
                <h1 class="text-center">{{$contents->title}}</h1>
                <p class="text-center mt-3 mb-1">来源：{{$contents->from}}&nbsp;&nbsp;&nbsp;&nbsp;编辑：{{$contents->author}}&nbsp;&nbsp;&nbsp;&nbsp;发布时间：{{$contents->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;阅读数：{{$contents->view_count}}</p>
                <hr class="my-2">
                <p class="lead p-2">{{$contents->desc}}</p>
                <p>{!! $contents->content !!}</p>
            </div>
        </div>
        <div class="col-3 px-1">
            <div class="ad3 my-1 border" style="background-color: #00a65a;height: 300px">广告3</div>
            @include('pages.content._hot')
        </div>
    </div>
@stop
