<?php

namespace App\Admin\Controllers;

use App\Admin\Module\MemberData;
use App\Admin\Module\MemberDetail;
use App\Models\Member;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Http\Controllers\AdminController;

class MemberController extends AdminController
{
    private $realname;
    private $upper_id;
    private $upper;
    private $wallet;

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $build = Member::with(["upper", "wallet"]);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('upper_id', '上级ID')->display(function () {
                return $this->upper_id ? $this->upper_id : "顶级用户";
            });
            $grid->column('upper.mobile', '上级手机号')->display(function () {
                return $this->upper_id ? $this->upper->mobile : "顶级用户";
            });
            $grid->column('username');
            $grid->column('mobile');
            $grid->column('first_consume');
            $grid->column('wallet.chip_num', '当前碎片数')->display(function () {
                return $this->wallet ? $this->wallet->chip_num : 0;
            });
            $grid->column('wallet.chip_total', '拥有碎片总数')->display(function () {
                return $this->wallet ? $this->wallet->chip_total : 0;
            });
            $grid->column('realname', '是否实名')->display(function () {
                return $this->realname ? "是" : "否";
            });
            $grid->column('create_time');
            $grid->column('status')->switch();;
            $grid->column('invite_code', '邀请码');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal("mobile")->width(2);
                $filter->between("create_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '开启', '0' => '关闭'])->width(2);
            });

            $grid->model()->orderBy("create_time", "desc");
            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();
        });
    }

    /**
     * 用户详情
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content): Content
    {
        return $content->header('用户')
            ->description('详情')
            ->body(function (Row $row) use ($id) {
                $row->column(3, new MemberDetail(['id' =>$id]));
                $row->column(9, new MemberData(['id'=>$id]));
            });
    }
}
