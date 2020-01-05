<div class="headline col-3 px-1">
    <div class="card shadow">
        <div class="card-header bg-white">
            头条推荐
        </div>
        <ul class="list-group list-group-flush">
            @if(!empty($headlines))
                @foreach($headlines as $value)
                    <li class="list-group-item py-2 px-3">
                        <a class="title d-inline-block text-truncate" href="/articles/{{$value->id}}">{{$value->title}}</a>
                        <span class="float-left cate px-1"><a href="/cates/{{$value->categories->id}}">{{$value->categories->title}}</a></span>
                        <span class="date float-right font-italic">发布于{{$value->created_at->diffForHumans()}}</span>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
