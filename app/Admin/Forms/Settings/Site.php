<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Site extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '网站';

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
        $this->text('website_contact_name',__('联系人'))->rules('required');
        $this->email('website_contact_email',__('联系邮箱'))->rules('email');
        $this->datetime('website_created_at',__('创建时间'));
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
