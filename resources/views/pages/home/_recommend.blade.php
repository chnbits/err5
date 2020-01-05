<div class="recommend row px-0">
    @if(!empty($recommends))
        @foreach($recommends as $value)
            <div class="col-3 px-0">
                <div class="card px-0 mx-1 border shadow">
                    <a href="/articles/{{$value->id}}"><img src="/uploads/{{$value->image}}" class="card-img-top" alt="{{$value->title}}"></a>
                    <div class="card-body p-2">
                        <h5 class="card-title"><a href="/articles/{{$value->id}}">{{$value->title}}</a></h5>
                        <p class="card-text">{{$value->desc}}</p>
                        <p>
                            <span class="cate float-left px-2 mt-1"><a href="/cates/{{$value->categories->id}}">{{$value->categories->title}}</a></span>
                            <span class="publish float-right font-italic mt-1">发布于{{$value->created_at->diffForHumans()}}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
