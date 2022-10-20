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
        $this->marketing = Grid::make(new MemberMarketing(), function (Grid $grid) use ($id) {
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->model()->where("member_id", $id);

            $grid->column('id', 'ID')->sortable();
            $grid->column('member_id', '用户')->sortable();
            $grid->column('order_id', '订单号');
            $grid->column('rate', '分润比例');
            $grid->model()->orderBy("create_time", "desc");

            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableQuickEdit();
                $actions->disableView();
            });
        });
    }

    public function renderContent()
    {
        $tab = Tab::make();
        //添加两个选项卡
        $tab->add('分润明细', $this->marketing, true);
        return $tab->withCard() . "";
    }
}
