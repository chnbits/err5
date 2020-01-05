@extends('layouts.app')
@section('title', isset($cate_title) ? $cate_title->title : '列表页')

@section('content')
    <div class="cate_title row mt-3 px-1">
        <div class="media">
            @if(!empty($cate_title->image))
                <img src="/uploads/{{$cate_title->image}}" class="align-self-center mr-3" alt="{{$cate_title->title}}">
            @endif
            @if(!empty($cate_title->title))
                    <div class="media-body py-3">
                        <h2 class="m-0 float-left">{{$cate_title->title}}</h2>
                        <span class="mb-0 mt-1 pl-3 pt-2 float-left">{{$cate_title->desc}}</span>
                    </div>
            @endif
                <div class="media-body py-3">
                    <h2 class="m-0 float-left">搜索结果</h2>
                    <span class="mb-0 mt-1 pl-3 pt-2 float-left">搜索结果</span>
                </div>
        </div>
    </div>
    <div class="lists row">
        <div class="col-9 px-1">
            <div class="infinite-scroll">
                @if(!empty($lists))
                    @foreach($lists as $value)
                        <div class="media bg-white border shadow my-1">
                            <img src="/uploads/{{$value->image}}" class="align-self-center mr-3" alt="{{$value->title}}">
                            <div class="media-body py-2 pr-3">
                                <h5 class="mt-1 font-weight-bold"><a href="/articles/{{$value->id}}">{{$value->title}}</a></h5>
                                <p class="mb-1">{{$value->desc}}</p>
                                <p class="mb-0">
                                    <span class="cate px-2"><a href="/cates/{{$value->categories->id}}">{{$value->categories->title}}</a></span>
                                    <span class="info font-italic">发布于{{$value->created_at}}&nbsp;<span style="font-style: normal">|</span></span>
                                    <span class="view font-italic">{{$value->view_count}}次阅读</span>
                                    <span class="more float-right font-italic mt-1"><a href="/articles/{{$value->id}}">详细内容&gt;&gt;</a></span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="text-center">
                    @if( $lists->currentPage() == $lists->lastPage())
                        <span class="text-center text-muted">没有更多了</span>
                    @else
                        <a class="jscroll-next btn btn-block font" href="{{ $lists->nextPageUrl() }}">
                            点击 加载更多....
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-3 px-1">
            <div class="ad3 my-1 border" style="background-color: #00a65a;height: 300px">广告3</div>
            @include('pages.list._hot')
        </div>
    </div>

@stop
