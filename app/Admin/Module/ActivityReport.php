<?php

namespace App\Admin\Module;

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;

class ActivityReport
{
    public static function list() {
        Admin::translation('activity-report');
        $build = \App\Models\ActivityReport::with(["activity"]);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('activity_id');
            $grid->column('activity.name');
            $grid->column('sell_amount');
            $grid->column('chip_total');
            $grid->column('sell_a');
            $grid->column('sell_b');
            $grid->column('sell_c');
            $grid->column('sell_d');
            $grid->column('sell_e');
            $grid->column('chip_a');
            $grid->column('chip_b');
            $grid->column('chip_c');
            $grid->column('chip_d');
            $grid->column('chip_e');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like("activity_name")->width(5);
            });

            $grid->model()->orderBy("create_time", "desc");
            $grid->disableActions();
            $grid->disableRowSelector();
            $grid->disableCreateButton();
        });
    }
}
