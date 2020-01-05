<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Recommend;
use App\Models\Tag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class ArticleController extends AdminController
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('admin.index'))
            ->description(trans('admin.description'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('admin.detail'))
            ->description(trans('admin.description'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('admin.edit'))
            ->description(trans('admin.description'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('admin.create'))
            ->description(trans('admin.description'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);

        $grid->model()->orderBy('order','asc');
        $grid->column('id',__('ID'));
        $grid->column('order',__('排序'))->orderable();
        $grid->column('categories.title',__('分类'))->label();
        $grid->column('title',__('标题'))->width(200);
        $grid->column('image',__('图片'))->image('',160,120);
        $grid->column('from',__('来源'));
        $grid->column('author',__('作者'));
        $grid->column('desc',__('描述'))->width(400);
        $grid->column('status',__('状态'))->switch([
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'danger'],
        ]);
        $states = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];
        $grid->column('switch',__('推荐'))->switchGroup([
            'is_headline'=>'头条','is_slider'=>'轮播','is_recommend'=>'推荐'
        ],$states);
        $grid->column('tags',__('Tag'))->pluck('name')->label();
        $grid->column('created_at',__(trans('admin.created_at')));
//        $grid->column('updated_at',__(trans('admin.updated_at')));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id',__('ID'));
        $show->field('pid',__('父类ID'));
        $show->field('cid',__('分类ID'));
        $show->field('title',__('标题'));
        $show->field('from',__('来源'));
        $show->field('author',__('作者'));
        $show->field('order',__('排序'));
        $show->field('status',__('状态'))->using([
            '1'=>'正常','0'=>'禁用'
        ])->label();
        $show->field('is_recommend',__('推荐'))->using([
            '1'=>'打开','0'=>'关闭'
        ])->label();
        $show->field('is_headline',__('头条'))->using([
            '1'=>'打开','0'=>'关闭'
        ])->label();
        $show->field('is_slider',__('轮播'))->using([
            '1'=>'打开','0'=>'关闭'
        ])->label();
        $show->field('image',__('图片'))->image();
        $show->field('desc',__('描述'));
        $show->field('content',__('内容'))->link();
        $show->field('created_at',__(trans('admin.created_at')));
        $show->field('updated_at',__(trans('admin.updated_at')));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article);

        $form->display('id',__('ID'));
        $form->select('pid',__('父类ID'))->options(Category::selectOptions())->load('cid','/api/getcid');
        $form->select('cid',__('分类ID'));
        $form->text('title',__('标题'));
        $form->text('from',__('来源'));
        $form->number('order',__('排序'));
        $form->text('author',__('作者'))->default(Auth::guard('admin')->user()->username);
        $form->image('image',__('图片'));
        $form->textarea('desc',__('描述'));
        $form->UEditor('content',__('内容'));
        $form->multipleSelect('tags',__('Tags'))->options(Tag::where('status','1')->select('id','name as text')->pluck('text','id'));
        $form->switch('status',__('状态'))->default('1')->states([
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'danger'],
        ]);
        $form->fieldset('推荐项',function (Form $form){
            $form->switch('is_headline',__('头条'))->default('0')->states([
                'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ]);
            $form->switch('is_recommend',__('推荐'))->default('0')->states([
                'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ]);
            $form->switch('is_slider',__('轮播'))->default('0')->states([
                'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ]);
        });


        $form->display('created_at',__(trans('admin.created_at')));
        $form->display('updated_at',__(trans('admin.updated_at')));

        return $form;
    }
}
