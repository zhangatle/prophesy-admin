<?php

namespace App\Admin\Controllers;

use App\Admin\Module\OrderDetail;
use App\Models\Order;
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
    protected function grid(): Grid
    {
        $build = Order::with(['activity', 'member']);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('member.username', '用户昵称');
            $grid->column('order_no');
            $grid->column('activity.name', '活动名称');
            $grid->column('member.mobile', '手机号');
            $grid->column('actual_price');
            $grid->column('channel')->using([1=>'碎片', 2 =>'支付宝']);
            $grid->column('payment_time');
            $grid->column('status')->using([1=>'已完成', 0 =>'待付款']);
            $grid->column('create_time');

            $grid->model()->orderBy("create_time", "desc");

            $grid->disableDeleteButton();
            $grid->disableCreateButton();
            $grid->disableEditButton();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal('order_no')->width(2);
                $filter->equal('member.mobile')->width(2);
                $filter->between("create_time", '下单时间')->datetime()->width(4);
                $filter->equal('status')->select(['1' => '已完成', '0' => '待付款'])->width(2);
                $filter->equal('channel')->select(['1' => '碎片', '2' => '支付宝'])->width(2);
            });
        });
    }

    public function show($id, Content $content): Content
    {
        return $content
            ->body(Show::make($id, new Order(), function (Show $show) use($id) {
                $show->disableDeleteButton();
                $show->disableEditButton();
                $show->html(new OrderDetail(['id'=>$id]));
            }));
    }
}
