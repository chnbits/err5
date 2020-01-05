<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Basic extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '基本';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $data = $request->all();
//        dd($data);
//        dd(DB::table('admin_config')->where('name','website_logo')->get('value as website_logo')->first()->website_logo);
        if ($request->website_logo != null){
            $data['website_logo'] = $request->file('website_logo')->store('/website','admin');
        }
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
        $this->switch('website_enable', __('站点开关'))->states([
            'on'  => ['value' => 'on', 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 'off', 'text' => '关闭', 'color' => 'danger'],
        ])->help('站点关闭后将不能访问，后台可正常登录');
        $this->text('website_title', __('站点标题'))->help("调用方式：config('website_title')");
        $this->text('website_slogan', __('站点标语'))->help("站点口号，调用方式：config('website_slogan')");
        $this->image('website_logo', __('站点LOGO'))->uniqueName();
        $this->text('website_text_logo', __('站点LOGO文字'));
        $this->textarea('website_desc', __('站点描述'))->help('网站描述，有利于搜索引擎抓取相关信息');
        $this->text('website_keywords', __('站点关键词'))->help('网站搜索引擎关键字');
        $this->text('website_copyright', __('版权信息'))->help("调用方式：config('website_copyright')");
        $this->text('website_icp', __('备案信息'))->help("调用方式：config('website_icp')");
        $this->text('website_beian', __('公安备案信息'))->help("调用方式：config('website_beian')");
        $this->textarea('website_statistics', __('网站统计代码'))->help("网站统计代码，支持百度、Google、cnzz等，调用方式：config('website_statistics')");
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function data()
    {
        $configs = DB::table('admin_config')->get()->pluck('value','name')->toJson();
        $configs_arr = json_decode($configs,true);
        return $configs_arr;
    }
}
