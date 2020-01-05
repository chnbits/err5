<?php

namespace App\Providers;

use Encore\Admin\Config\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $table = config('admin.extensions.config.table', 'admin_config');
        if (Schema::hasTable($table)) {
            Config::load();
        }

        $cates = DB::table('categories')->where('status','1')->get()->all();
        $tags = DB::table('tags')->where('status','1')->get()->all();
        $hots = DB::table('articles')->where('status','1')->orderBy('view_count','desc')->take(10)->get();
        View::share(['cates'=>$cates,'tags'=>$tags,'hots'=>$hots]);
    }
}
