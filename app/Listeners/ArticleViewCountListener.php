<?php

namespace App\Listeners;

use App\Events\ArticleViewCount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Cache;

class ArticleViewCountListener
{
    /**
     * @var Store
     */
    private $session;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ArticleViewCount $event)
    {
        $ip = request()->getClientIp();
        $article = $event->article;

        if (!$this->hasViewedArticle($article,$ip))
        {
            $article->view_count = $article->view_count + 1;
            $article->timestamps = false;
            $article->save();
            $this->storeViewedArticle($article,$ip);
        }
    }
    protected function hasViewedArticle($article,$ip)
    {
        return Cache::has('viewed_Articles_' . $ip. $article->id);
    }
    protected function storeViewedArticle($article,$ip)
    {
        $key = 'viewed_Articles_' . $ip . $article->id;
        // 3 分钟过期
        Cache::put($key, time(), 3);
    }
}
