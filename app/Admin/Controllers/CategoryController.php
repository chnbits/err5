<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\Auth;

class CategoryController extends AdminController
{
    use ModelForm;

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
            ->row(function (Row $row) {
                $row->column(6, $this->treeView());

                $row->column(6, function (Column $column){
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('categories'));

                    $form->hidden('id',__('ID'));
                    $form->text('title',__('名称'));
                    $form->icon('icon',__('图标'));
                    $form->select('parent_id',__('父分类'))->options(Category::selectOptions());
                    $form->number('order', __('排序'));
                    $form->text('author', __('添加者'))->default(Auth::guard('admin')->user()->username);
                    $form->image('image', __('图标'));
                    $form->textarea('desc', __('描述'));
                    $form->switch('status', __('状态'))->states([
                        'on'  => ['value' => '1', 'text' => '打开', 'color' => 'success'],
                        'off' => ['value' => '0', 'text' => '关闭', 'color' => 'danger'],
                    ])->default('1');
                    $form->hidden('created_at',__(trans('admin.created_at')));
                    $form->hidden('updated_at',__(trans('admin.updated_at')));

                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));

                });
            });
    }

    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                return "{$branch['id']}&nbsp;&nbsp;-&nbsp;&nbsp;<i class='fa {$branch['icon']}'></i>&nbsp;&nbsp;<strong>{$branch['title']} &nbsp;-&nbsp;{$branch['desc']}</strong>";
            });
        });
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
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category);

        $form->hidden('id',__('ID'));
        $form->text('title',__('名称'));
        $form->icon('icon',__('图标'));
        $form->select('parent_id',__('父分类'))->options(Category::selectOptions());
        $form->number('order', __('排序'))->default('0');
        $form->text('author', __('添加者'))->default(Auth::guard('admin')->user()->username);
        $form->image('image', __('图片'));
        $form->textarea('desc', __('描述'));
        $form->switch('status', __('状态'))->states([
            'on'  => ['value' => '1', 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => '0', 'text' => '关闭', 'color' => 'danger'],
        ])->default('1');
        $form->hidden('created_at',__(trans('admin.created_at')));
        $form->hidden('updated_at',__(trans('admin.updated_at')));

        return $form;
    }
}
