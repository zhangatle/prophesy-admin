<?php

namespace App\Admin\Controllers;

use App\Models\Transition;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class TransitionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new Transition(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('out_member_id');
            $grid->column('out_name');
            $grid->column('out_mobile');
            $grid->column('in_member_id');
            $grid->column('in_name');
            $grid->column('in_mobile');
            $grid->column('product_name');
            $grid->column('product_no');
            $grid->column('create_time');
            $grid->column('channel')->using([1=>'内部', 2=>'外部']);
            $grid->model()->orderBy("create_time", "desc");

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal('in_mobile')->width(3);
                $filter->equal('out_mobile')->width(3);
                $filter->between("create_time")->datetime()->width(3);
            });
            $grid->disableActions();
            $grid->disableCreateButton();
        });
    }
}
