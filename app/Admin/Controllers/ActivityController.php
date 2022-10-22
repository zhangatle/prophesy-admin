<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Activity;
use Carbon\Carbon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ActivityController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Activity(), function (Grid $grid) {
            $grid->actions(function (Grid\Displayers\Actions $actions){
                $start_time = $actions->row->start_time;
                if($start_time < Carbon::now()) {
                    $actions->disableEdit();
                }
            });

            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('img_url')->image("", "50", "50");
            $grid->column('detail')->display(function ($pictures) {
                return json_decode($pictures, true);
            })->image("", 50, 50);
            $grid->column('price');
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('status')->using([0 => '禁用', 1 => '启用']);;
            $grid->column('kt_status')->using([0 => '未空投', 1 => '已空投']);
            $grid->column('create_time');
            $grid->column('activity_status')->display(function () {
                if ($this->start_time > Carbon::now()) {
                    return "未开始";
                } elseif ($this->end < Carbon::now()) {
                    return "已结束";
                } else {
                    return "进行中";
                }
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like("name")->width(2);
                $filter->between("start_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '开启', '0' => '关闭'])->width(2);
            });
            $grid->disableDeleteButton();
            $grid->disableRowSelector();
            $grid->disableViewButton();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Activity(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('img_url');
            $show->field('detail');
            $show->field('price');
            $show->field('start_time');
            $show->field('end_time');
            $show->field('status');
            $show->field('kt_status');
            $show->field('sort');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Activity(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->image('img_url')->autoUpload();
            $form->multipleImage("detail", '活动详情')->saving(function ($paths) {
                return json_encode($paths);
            })->autoUpload()->uniqueName();
            $form->datetimeRange('start_time', 'end_time', '时间范围');
            $form->text('price');
            $form->text('status');
            $form->text('kt_status');
            $form->text('sort');
        });
    }

//    public function edit($id, Content $content) {
//        return $content
//            ->translation($this->translation())
//            ->title($this->title())
//            ->description($this->description()['edit'] ?? trans('admin.edit'))
//            ->body($this->form()->edit($id));
//    }
//
//    public function update($id) {
//        return $this->form()->update($id);
//    }
}
