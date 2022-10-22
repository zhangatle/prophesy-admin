<?php

namespace App\Admin\Controllers;

use App\Admin\Module\OrderDetail;
use App\Admin\Repositories\Order;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
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
            $grid->column('chip_num_all');
            $grid->column('create_time');

            $grid->disableDeleteButton();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    public function show($id, Content $content)
    {
        return $content
            ->body(Show::make($id, new Order(), function (Show $show) use($id) {
                $show->disableDeleteButton();
                $show->disableEditButton();
                $show->html(new OrderDetail(['id'=>$id]));
            }));
    }
}
