<?php

namespace App\Admin\Module;

use App\Admin\Repositories\Order;
use App\Admin\Repositories\Transition;
use App\Admin\Repositories\Withdrawal;
use App\Models\MemberMarketing;
use Dcat\Admin\Grid;
use Dcat\Admin\Widgets\Metrics\Card;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Http\Request;

class MarketingDetail extends Card
{
    protected $data;
    protected $marketing;

    // 构造方法参数必须设置默认值
    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct();
    }

    protected function init()
    {
        parent::init();
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
        $m_build = MemberMarketing::with(["order"]);
        $this->marketing = Grid::make($m_build, function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("member_id", $id);

            $grid->column('order_no', '订单号')->width("25%");
            $grid->column('order.actual_price', '订单金额');
            $grid->column('rate', '分润比例');
            $grid->column('rate_price', '分润金额');
            $grid->column('cur_price', '当前余额');
            $grid->model()->orderBy("create_time", "desc");

            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableActions();
        });
    }

    public function renderContent()
    {

        return $this->marketing . "";
    }
}
