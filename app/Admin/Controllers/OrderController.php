<?php

namespace App\Admin\Controllers;

use App\Admin\Module\MemberData;
use App\Admin\Module\MemberDetail;
use App\Admin\Module\OrderDetail;
use App\Admin\Repositories\Order;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
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
        $build = Order::with(['activity', 'member']);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('member.username', '用户昵称');
            $grid->column('order_no');
            $grid->column('activity.name');
            $grid->column('member.mobile', '手机号');
            $grid->column('actual_price');
            $grid->column('channel');
            $grid->column('payment_time');
            $grid->column('status')->using([1=>'已完成', 0 =>'未完成']);
            $grid->column('chip_num');
            $grid->column('create_time');
            $grid->column('delete_time');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    public function show($id, Content $content)
    {
        return $content->header('订单详情')
            ->description('详情')
            ->body(function (Row $row) use ($id) {
                $row->column(12, new OrderDetail(['id'=>$id]));
            });
    }
}
