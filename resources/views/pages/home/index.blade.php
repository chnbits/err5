@extends('layouts.app')
@section('title', '首页')

@section('content')
    <div class="top_row row pt-3">
{{-- 轮播部分       --}}
        @include('pages.home._slider')
{{--头条部分        --}}
        @include('pages.home._headline')
    </div>
{{--广告图片--}}
    <div class="ad1 row my-2" style="background-color: #7a869d;height: 60px;margin:0 -11px;">广告1</div>
    <div class="ad1 row my-2" style="background-color: #0c5460;height: 60px;margin:0 -11px;">广告2</div>
{{--推荐部分--}}
    @include('pages.home._recommend')
{{--列表部分    --}}
    <div class="list row my-2">
        {{--列表部分    --}}
        @include('pages.home._list')

{{--        热门资讯--}}
        <div class="col-3 px-1">
            <div class="ad3 my-1 border" style="background-color: #00a65a;height: 300px">广告3</div>
            @include('pages.home._hot')
        </div>
    </div>
@stop
