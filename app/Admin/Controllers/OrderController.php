<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Order;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Order(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('member_id');
            $grid->column('order_no');
            $grid->column('activity_id');
            $grid->column('activity_name');
            $grid->column('username');
            $grid->column('mobile');
            $grid->column('actual_price');
            $grid->column('channel');
            $grid->column('payment_time');
            $grid->column('status');
            $grid->column('chip_num');
            $grid->column('create_time');
            $grid->column('delete_time');
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
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
        return Show::make($id, new Order(), function (Show $show) {
            $show->field('id');
            $show->field('member_id');
            $show->field('order_no');
            $show->field('activity_id');
            $show->field('activity_name');
            $show->field('username');
            $show->field('mobile');
            $show->field('actual_price');
            $show->field('channel');
            $show->field('payment_time');
            $show->field('status');
            $show->field('chip_num');
            $show->field('create_time');
            $show->field('delete_time');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Order(), function (Form $form) {
            $form->display('id');
            $form->text('member_id');
            $form->text('order_no');
            $form->text('activity_id');
            $form->text('activity_name');
            $form->text('username');
            $form->text('mobile');
            $form->text('actual_price');
            $form->text('channel');
            $form->text('payment_time');
            $form->text('status');
            $form->text('chip_num');
            $form->text('create_time');
            $form->text('delete_time');
        });
    }
}
