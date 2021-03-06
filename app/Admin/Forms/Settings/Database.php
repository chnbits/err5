<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Database extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '数据库';

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
        $this->text('website_backup_path', __('备份根路径'))->rules('required')->help('路径必须以 / 结尾');
        $this->text('website_backup_size', __('备份卷大小'))->rules('required')->help('该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M');
        $this->radio('website_backup_zip', __('备份是否压缩'))->options([1 => '是', 0 => '否'])->help('压缩备份文件需要PHP环境支持 gzopen, gzwrite函数');
        $this->radio('website_backup_zip_level', __('备份压缩级别'))->options([1 => '最低', 2 => '一般', 3 => '最高'])->help('数据库备份文件的压缩级别，该配置在开启压缩时生效');
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
