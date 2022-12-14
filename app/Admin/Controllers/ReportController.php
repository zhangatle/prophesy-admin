<?php

namespace App\Admin\Controllers;

use App\Admin\Module\ActivityReport;
use App\Admin\Module\DailyReport;
use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

/**
 * 活动报表
 */
class ReportController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('活动报表')
            ->body(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->row(ActivityReport::list());
                });
            });
    }

    /**
     * 日报
     * @param Content $content
     * @return Content
     */
    public function daily(Content $content)
    {
        return $content
            ->header('日报')
            ->body(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->row(DailyReport::list());
                });
            });
    }
}
