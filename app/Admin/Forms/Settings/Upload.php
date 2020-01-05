<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Upload extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '上传';

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
        $file_ext =['doc','docx','xls','ppt','pptx','pdf','wps', 'txt', 'rar', 'zip', 'gz','bz2','7z'];
        $img_ext =['gif', 'bmp', 'jpeg', 'png'];
        $this->number('website_file_size', '文件上传大小限制')->help('0为不限制大小，单位：kb')->rules('required');
        $this->tags('website_file_ext', '允许上传的文件后缀')->options($file_ext)->help('多个后缀用逗号隔开，不填写则不限制类型')->rules('required');
        $this->number('website_image_size', '图片上传大小限制')->help('0为不限制大小，单位：kb')->rules('required');
        $this->tags('website_image_ext', '允许上传的图片后缀')->options($img_ext)->help('多个后缀用逗号隔开，不填写则不限制类型')->rules('required');
        $this->number('website_thumbnail_size', '缩略图尺寸');
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
        $file_ext_str = $configs_arr['website_file_ext'];
        $image_ext_str = $configs_arr['website_image_ext'];
        $configs_arr['website_file_ext']=json_decode($file_ext_str,true);
        $configs_arr['website_image_ext']=json_decode($image_ext_str,true);
//        var_dump($configs_arr);
        return $configs_arr;
    }
}
