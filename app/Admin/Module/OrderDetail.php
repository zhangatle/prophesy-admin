<?php

namespace App\Admin\Module;

use App\Models\Order;
use App\Models\OrdersChild;
use Dcat\Admin\Grid;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Http\Request;

class OrderDetail extends Card
{
    protected $data;
    protected $order;
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
        $this->title('基本信息');
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
        $order_no = Order::query()->where("id", $id)->pluck("order_no")->first();
        $this->order_no = $order_no;
        $build = Order::with(["activity", "member", "child"]);
        $this->activity = Grid::make($build, function (Grid $grid) use ($id, $order_no) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("order_no", $order_no);
            $grid->column('activity.name', '活动名称');
            $grid->column('activity.start_time', '开始时间');
            $grid->column('activity.end_time', '结束时间');
            $grid->withBorder();

            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disablePagination();
            $grid->disableActions();
        });
        $this->order = Grid::make($build, function (Grid $grid) use ($id, $order_no) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("order_no", $order_no);
            $grid->column("order_no", '订单号');
            $grid->column('member.username', '用户昵称');
            $grid->column('member.id', '用户ID');
            $grid->column('member.realname', '真实姓名');
            $grid->column('member.mobile', '手机号');
            $grid->column('channel', '支付渠道')->using([1=>'碎片', 2=>'支付宝']);
            $grid->column('payment_time', '支付时间');
            $grid->column('status', '订单状态')->using([1=>'已完成', 0 =>'待付款']);
            $grid->column('create_time', '下单时间');

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
            $grid->column("id", '子订单ID');
            $grid->column("type")->using([
                1=> '猜谁会赢',
                2=> '加大难度猜',
                3=> '整场进球数',
                4=> '预言比分',
                5=> '猜范围'
            ]);
            $grid->column("keyword", '规则');
            $grid->column("number", '购买数量');
            $grid->column("chip_num", '碎片');
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
