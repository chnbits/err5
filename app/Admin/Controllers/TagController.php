<?php

namespace App\Admin\Controllers;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
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
        $grid = new Grid(new Tag);

        $grid->column('id',__('ID'));
        $grid->column('title',__('Tag标签'));
        $grid->column('icon',__('Tag图标'));
        $grid->column('author',__('添加者'));
        $grid->column('status',__('状态'))->using([
            '1'=>'正常','0'=>'禁用'
        ])->label();
        $grid->column('created_at',trans('admin.created_at'));
        $grid->column('updated_at',trans('admin.updated_at'));

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
        $show = new Show(Tag::findOrFail($id));

        $show->field('id',__('ID'));
        $show->field('title',__('Tag标签'));
        $show->field('icon',__('Tag图标'));
        $show->field('author',__('添加者'));
        $show->field('status',__('状态'))->using([
            '1'=>'正常','0'=>'禁用'
        ]);
        $show->field('created_at',trans('admin.created_at'));
        $show->field('updated_at',trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Tag);

        $form->display('id',__('ID'));
        $form->text('title', __('Tag标签'));
        $form->icon('icon',__('Tag图标'));
        $form->text('author', __('添加者'))->default(Auth::guard('admin')->user()->username);
        $form->switch('status', __('状态'))->default('1')->states([
            'on'  => ['value' => 1, 'text' => '正常', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '禁用', 'color' => 'danger'],
        ]);

        $form->display('created_at',__(trans('admin.created_at')));
        $form->display('updated_at',__(trans('admin.updated_at')));

        return $form;
    }
}
