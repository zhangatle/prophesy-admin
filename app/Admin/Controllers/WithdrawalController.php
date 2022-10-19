<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Withdrawal;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class WithdrawalController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Withdrawal(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('member_id');
            $grid->column('apply_name');
            $grid->column('apply_mobile');
            $grid->column('apply_price');
            $grid->column('account');
            $grid->column('status');
        
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
        return Show::make($id, new Withdrawal(), function (Show $show) {
            $show->field('id');
            $show->field('member_id');
            $show->field('apply_name');
            $show->field('apply_mobile');
            $show->field('apply_price');
            $show->field('account');
            $show->field('status');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Withdrawal(), function (Form $form) {
            $form->display('id');
            $form->text('member_id');
            $form->text('apply_name');
            $form->text('apply_mobile');
            $form->text('apply_price');
            $form->text('account');
            $form->text('status');
        });
    }
}
