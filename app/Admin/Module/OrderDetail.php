<?php

namespace App\Admin\Module;

use App\Admin\Repositories\Order;
use App\Admin\Repositories\Transition;
use App\Admin\Repositories\Withdrawal;
use App\Models\OrdersChild;
use Dcat\Admin\Grid;
use Dcat\Admin\Widgets\Metrics\Card;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Http\Request;

class OrderDetail extends Card
{
    protected $data;
    protected $ordr;
    protected $activity;
    protected $sku;
    protected $order_no;

    // 构造方法参数必须设置默认值
    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct();
    }

    protected function init()
    {
        parent::init();
        // 设置标题
        $this->title('行为数据');
    }

    // 传递自定义参数到 handle 方法
    public function parameters() : array
    {
        return $this->data;
    }

    /**
     * 处理请求.
     *
     * @param Request $request
     *
     * @return void
     */
    public function handle(Request $request)
    {
        // 获取外部传递的自定义参数
        $id = $request->get("id");
        $order_no = \App\Models\Order::query()->where("id", $id)->first()->pluck("order_no");
        $build = Order::with(["activity", "member", "child"]);
        $this->activity = Grid::make($build, function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("member_id", $id);
            $grid->column('activity.name', '活动名称')->sortable();
            $grid->column('activity.start_time', '开始时间')->sortable();
            $grid->column('activity.end_time', '结束时间')->sortable();
            $grid->model()->orderBy("create_time", "desc");
            $grid->withBorder();

            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disablePagination();
            $grid->disableActions();
        });
        $this->order = Grid::make($build, function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("member_id", $id);
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

            $this->order_no = $grid->column("order_no");

            $grid->withBorder();

            $grid->disableActions();
            $grid->disablePagination();
            $grid->disableRowSelector();
            $grid->disableRefreshButton();
            $grid->disableCreateButton();
        });

        $sku_build = OrdersChild::with(["activity"]);
        $this->sku = Grid::make($sku_build, function (Grid $grid) use ($order_no) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("order_no", $order_no);
            $grid->column("id");
            $grid->column("order_no");
            $grid->column("activity.name");
            $grid->column("type");
            $grid->column("keywork");
            $grid->column("number");
            $grid->column("chip_num");
            $grid->column("status");
            $grid->column("price");
            $grid->withBorder();

            $grid->disableActions();
            $grid->disablePagination();
            $grid->disableRowSelector();
            $grid->disableRefreshButton();
            $grid->disableCreateButton();
        });
    }

    public function renderContent()
    {
        $activity_title = '
        <div class="card-header d-flex justify-content-between align-items-start pb-0">
        <div><h4 class="card-title mb-1">活动信息</h4>
        </div>
        </div>
        ';
        $sku_title = '
        <div class="card-header d-flex justify-content-between align-items-start pb-0">
        <div><h4 class="card-title mb-1">购买的SKU</h4>
        </div>
        </div>
        ';
        return $this->order. $activity_title.$this->activity . $sku_title . $this->sku;
    }
}
