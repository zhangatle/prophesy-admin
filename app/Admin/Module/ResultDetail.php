<?php

namespace App\Admin\Module;


use App\Models\Order;
use Dcat\Admin\Grid;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Http\Request;

class ResultDetail extends Card
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
        $m_build = Order::with(["member", "child"]);
        $this->marketing = Grid::make($m_build, function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("activity_id", $id);
            $grid->column('order_no', '订单号')->width("25%");
            $grid->column('member.username', '购买人昵称')->width("25%");
            $grid->column('member.mobile', '购买人电话')->width("25%");
            $grid->column('actual_price', '订单金额');
            $grid->column('payment_time', '支付时间');
            $grid->column('chip_num_all', '派发总量');
            $grid->column('child')->display(function ($childs) {
                $str = "";
                foreach ($childs as $child) {
                    if($child->type == 1) {
                        $str .= "A玩法:" .$child->chip_num. "X" . $child->number . "\n";
                    }elseif($child->type == 2) {
                        $str .= "B玩法:" .$child->chip_num. "X" . $child->number . "\n";
                    }elseif($child->type == 3) {
                        $str .= "C玩法:" .$child->chip_num. "X" . $child->number . "\n";
                    }elseif($child->type == 4) {
                        $str .= "D玩法:" .$child->chip_num. "X" . $child->number . "\n";
                    }
                }
                return $str;
            })->width("30%");

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
