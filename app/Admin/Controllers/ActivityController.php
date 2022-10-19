<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Activity;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
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
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('img_url');
            $grid->column('detail');
            $grid->column('price');
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('status');
            $grid->column('kt_status');
            $grid->column('sort');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like("name")->width(2);
                $filter->between("start_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '开启', '0' => '关闭'])->width(2);
            });
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
            $form->text('img_url');
            $form->text('detail');
            $form->text('price');
            $form->text('start_time');
            $form->text('end_time');
            $form->text('status');
            $form->text('kt_status');
            $form->text('sort');
        });
    }
}
