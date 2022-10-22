<?php

namespace App\Admin\Module;

use App\Models\Member;
use Carbon\Carbon;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Http\Request;

class MemberDetail extends Card
{
    // 保存自定义参数
    protected $data = [];
    protected $mobile;
    protected $username;
    protected $realname;
    protected $create_time;
    protected $status;
    protected $chip_num;
    protected $chip_total;
    protected $first_consume;
    protected $rate;
    protected $avatar;
    protected $member_id;

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
        $member_detail = Member::query()->find($id);
        $this->id = $member_detail->id;
        $this->mobile = $member_detail->mobile;
        $this->username = $member_detail->username;
        $this->realname = $member_detail->realname ? $member_detail->realname : "未实名";
        $this->create_time = Carbon::parse($member_detail->create_time);
        $this->status = $member_detail->status == 1 ? '正常' : '禁用';
        $this->chip_num = $member_detail->chip_num;
        $this->chip_total = $member_detail->chip_total;
        $this->rate = $member_detail->rate;
        $this->first_consume = $member_detail->first_consume;
        $this->avatar = "https://nft-markets.oss-cn-chengdu.aliyuncs.com/". $member_detail->avatar;
    }

    // 传递自定义参数到 handle 方法
    public function parameters() : array
    {
        return $this->data;
    }

    /**
     * 卡片内容.
     *
     * @return $this
     */
    public function renderContent()
    {
        return
            <<<HTML
<div class="col-md-12" style="padding: 20px;">
    <img style="width: 100%" src="{$this->avatar}" alt="">
</div>
<table class="table default-table">
    <tbody>
        <tr>
            <td>ID</td>
            <td>{$this->id}</td>
        </tr>
        <tr>
            <td>昵称</td>
            <td>{$this->username}</td>
        </tr>
        <tr>
            <td>真实姓名</td>
            <td>{$this->realname}</td>
        </tr>
        <tr>
            <td>注册时间</td>
            <td>{$this->create_time}</td>
        </tr>
        <tr>
            <td>用户状态</td>
            <td>{$this->status}</td>
        </tr>
        <tr>
            <td>手机号码</td>
            <td>{$this->mobile}</td>
        </tr>
        <tr>
            <td>当前碎片数量</td>
            <td>{$this->chip_num}</td>
        </tr>
        <tr>
            <td>首发消费</td>
            <td>{$this->first_consume}</td>
        </tr>
        <tr>
            <td>分润比例</td>
            <td>{$this->rate}</td>
        </tr>
        <tr>
            <td>碎片累计总数</td>
            <td>{$this->chip_total}</td>
        </tr>
        </tbody>
</table>
HTML;
    }
}
