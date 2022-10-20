<?php

namespace App\Admin\Module;

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;

class DailyReport
{
    public static function list() {
        Admin::translation('daily-report');
        return Grid::make(new \App\Models\DailyReport(), function (Grid $grid) {
            $grid->column('date');
            $grid->column('sell_amount');
            $grid->column('chip_total');
            $grid->column('promo_amount');
            $grid->column('withdrawal_amount');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like("activity_name")->width(5);
            });

            $grid->model()->orderBy("create_time", "desc");
            $grid->disableActions();
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableRefreshButton();
            $grid->disableFilterButton();
        });
    }
}
