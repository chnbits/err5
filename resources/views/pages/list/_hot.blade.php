<div class="card my-1 shadow">
    <div class="card-header bg-white">
        热门资讯
    </div>
    <ul class="list-group list-group-flush">
        @foreach($hots as $value)
            <li class="list-group-item"><a class="d-inline-block text-truncate" href="/articles/{{$value->id}}">{{$value->title}}</a></li>
        @endforeach
    </ul>
</div>
