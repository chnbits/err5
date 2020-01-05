<div class="slider col-9 px-1">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators mx-0 my-1">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner border shadow">
            <div class="carousel-item active">
                <a href="/articles/{{$top_slider->id}}"><img src="/uploads/{{$top_slider->image}}" class="d-block" alt="{{$top_slider->title}}"></a>
                <div class="carousel-caption d-none d-md-block px-3">
                    <a href="/articles/{{$top_slider->id}}"><h5>{{$top_slider->title}}</h5></a>
                    <p>
                        {{$top_slider->desc}}
                    </p>
                </div>
                <span class="px-2 my-1"><a href="/cates/{{$top_slider->categories->id}}">{{$top_slider->categories->title}}</a></span>
            </div>
            @if(!empty($sliders))
                @foreach($sliders as $value)
                    <div class="carousel-item">
                        <a href="/articles/{{$value->id}}"><img src="/uploads/{{$value->image}}" class="d-block" alt="{{$value->title}}"></a>
                        <div class="carousel-caption d-none d-md-block px-3">
                            <a href="/articles/{{$value->id}}"><h5>{{$value->title}}</h5></a>
                            <p>
                                {{$value->desc}}
                            </p>
                        </div>
                        <span class="px-2 my-1">{{$value->categories->title}}</span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
