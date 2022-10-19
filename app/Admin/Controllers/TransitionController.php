<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Transition;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TransitionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Transition(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('out_member_id');
            $grid->column('out_name');
            $grid->column('out_mobile');
            $grid->column('in_member_id');
            $grid->column('in_name');
            $grid->column('in_mobile');
            $grid->column('product_id');
            $grid->column('product_name');
            $grid->column('product_no');
            $grid->column('create_time');
            $grid->column('channel');
        
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
        return Show::make($id, new Transition(), function (Show $show) {
            $show->field('id');
            $show->field('out_member_id');
            $show->field('out_name');
            $show->field('out_mobile');
            $show->field('in_member_id');
            $show->field('in_name');
            $show->field('in_mobile');
            $show->field('product_id');
            $show->field('product_name');
            $show->field('product_no');
            $show->field('create_time');
            $show->field('channel');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Transition(), function (Form $form) {
            $form->display('id');
            $form->text('out_member_id');
            $form->text('out_name');
            $form->text('out_mobile');
            $form->text('in_member_id');
            $form->text('in_name');
            $form->text('in_mobile');
            $form->text('product_id');
            $form->text('product_name');
            $form->text('product_no');
            $form->text('create_time');
            $form->text('channel');
        });
    }
}
