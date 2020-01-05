<div class="header shadow border-bottom">
    <div class="header-nav">
        <div class="container px-0">
            <nav class="navbar p-0">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link px-2" href="/">首页</a>
                    </li>
                    @foreach($cates as $value)
                        <li class="nav-item">
                            <a class="nav-link px-2 mx-2" href="/cates/{{$value->id}}">{{$value->title}}</a>
                        </li>
                    @endforeach
                </ul>
                <form class="form-inline" action="/api/articles">
                    <input class="form-control mr-sm-2" name="keyword" type="search" placeholder="搜索" aria-label="Search">
                    <button class="btn btn-outline-success py-1 my-sm-0" type="submit">搜索</button>
                </form>
            </nav>
        </div>
    </div>
    <div class="header-bar">
        <div class="container px-0">
            <nav class="navbar p-0">
                <div class="col-2">
                    <span class="navbar-brand mb-0 pr-4">{{config('website_title')}}</span>
                </div>
                <div class="col-10 px-0 border-left">
                    <ul class="nav">
                        @foreach($tags as $value)
                        <li class="nav-item">
                            <a class="nav-link" href="/tags/{{$value->id}}">{{$value->title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
