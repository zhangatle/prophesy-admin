<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Synthetic;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SyntheticController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Synthetic(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('url');
            $grid->column('need_chip_num');
            $grid->column('detail');
            $grid->column('status');
            $grid->column('synthetic_status');
            $grid->column('create_time');

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
        return Show::make($id, new Synthetic(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('url');
            $show->field('need_chip_num');
            $show->field('detail');
            $show->field('status');
            $show->field('synthetic_status');
            $show->field('create_time');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Synthetic(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('url');
            $form->text('need_chip_num');
            $form->text('detail');
            $form->text('status');
            $form->text('synthetic_status');
            $form->text('create_time');
        });
    }
}
