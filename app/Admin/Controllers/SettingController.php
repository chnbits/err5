<?php
namespace App\Admin\Controllers;

use App\Admin\Forms\Settings;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets;

class SettingController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('网站设置')
            ->body(Widgets\Tab::forms([
                'basic'    => Settings\Basic::class,
                'site'     => Settings\Site::class,
                'upload'   => Settings\Upload::class,
                'database' => Settings\Database::class,
                'develop'  => Settings\Develop::class,
            ]));
    }
}
