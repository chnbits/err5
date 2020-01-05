<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Develop extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '开发';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        $data = $request->all();
        foreach ($data as $key => $value){
            DB::table('admin_config')->where('name',$key)->update(['value'=>$value]);
        }
        admin_success('更新成功！');
        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->radio('website_dev_mode', __('开发模式'))->options([0 => '关闭', 1 => '开启'])->stacked();
        $this->radio('website_show_trace', __('显示页面Trace'))->options([0 => '否', 1 => '是'])->stacked();
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $configs = DB::table('admin_config')->get()->pluck('value','name')->toJson();
        $configs_arr = json_decode($configs,true);
        return $configs_arr;
    }
}
