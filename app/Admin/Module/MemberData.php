<?php

namespace App\Admin\Module;

use App\Models\Order;
use App\Models\Transition;
use Dcat\Admin\Grid;
use Dcat\Admin\Widgets\Metrics\Card;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Http\Request;

class MemberData extends Card
{
    protected $data;
    protected $buy;
    protected $withdrawal;
    protected $transition_in;
    protected $transition_out;

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
        $buy_build = Order::with(["activity"]);
        $this->buy = Grid::make($buy_build, function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("member_id", $id);
            $grid->column('id', 'ID');
            $grid->column('create_time', '下单时间');
            $grid->column('order_no', '订单号');
            $grid->column('activity.name', '活动名称');
            $grid->column('actual_price', '实付');
            $grid->column('channel', '付款方式')->using([1=>'碎片', 2=>'支付宝']);
            $grid->column('status', '订单状态')->using([0=>'待支付', 1=>'已支付', 2=>'已过期']);
            $grid->column('chip_num_all', '碎片数');
            $grid->model()->orderBy("create_time", "desc");

            $grid->disableActions();
            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableRowSelector();
        });
        $this->transition_in = Grid::make(new Transition(), function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("in_member_id", $id);
            $grid->column('create_time', '创建时间');
            $grid->column('in_name', '转入人昵称');
            $grid->column('in_mobile', '转入人手机号');
            $grid->column('out_name', '转出人昵称');
            $grid->column('out_mobile', '转出人手机号');
            $grid->column('product_name', '商品名称');
            $grid->column('product_no', '商品编号');
            $grid->model()->orderBy("create_time", "desc");

            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableActions();
        });
        $this->transition_out = Grid::make(new Transition(), function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("out_member_id", $id);
            $grid->column('create_time', '创建时间');
            $grid->column('in_name', '转入人昵称');
            $grid->column('in_mobile', '转入人手机号');
            $grid->column('out_name', '转出人昵称');
            $grid->column('out_mobile', '转出人手机号');
            $grid->column('product_name', '商品名称');
            $grid->column('product_no', '商品编号');
            $grid->model()->orderBy("create_time", "desc");

            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableActions();
        });
    }

    public function renderContent()
    {
        $tab = Tab::make();
        //添加两个选项卡
        $tab->add('购买记录', $this->buy, true);
        $tab->add('转入记录', $this->transition_in);
        $tab->add('转出记录', $this->transition_out);
        return $tab->withCard() . "";
    }
}
