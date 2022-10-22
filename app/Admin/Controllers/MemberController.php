<?php

namespace App\Admin\Controllers;

use App\Admin\Module\MemberData;
use App\Admin\Module\MemberDetail;
use App\Admin\Repositories\Member;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Http\Controllers\AdminController;

class MemberController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $build = Member::with(["upper"]);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('upper.mobile', '上级手机号');
            $grid->column('username');
            $grid->column('mobile');
            $grid->column('first_consume');
            $grid->column('chip_num');
            $grid->column('chip_total');
            $grid->column('realname', '是否实名')->display(function () {
                return $this->realname ? "是" : "否";
            });
            $grid->column('create_time');
            $grid->column('avatar')->image("", 30, 30);
            $grid->column('status')->switch('', true);;
            $grid->column('invite_code');
            $grid->column('rate');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal("mobile")->width(2);
                $filter->between("create_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '开启', '0' => '关闭'])->width(2);
            });

            $grid->model()->orderBy("create_time", "desc");
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
//            $grid->actions([new SwitchStatus(\App\Models\Member::class)]);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Member(), function (Form $form) {
            $form->display('id');
            $form->display('mobile');
            $form->text('username');
            $form->text('rate');
            $form->image('avatar')->uniqueName()->autoUpload()->compress([
                'width' => 300,
                'height' => 300,
                // 图片质量，只有type为`image/jpeg`的时候才有效。
                'quality' => 90,
                // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
                'allowMagnify' => false,
            ]);
            $form->switch('status')
                ->customFormat(function ($v) {
                    return $v ? 1 : 0;
                })
                ->saving(function ($v) {
                    return $v ? 1 : 0;
                });
        });
    }

    public function show($id, Content $content)
    {
        return $content->header('用户')
            ->description('详情')
            ->body(function (Row $row) use ($id) {
                $row->column(3, new MemberDetail(['id' =>$id]));
                $row->column(9, new MemberData(['id'=>$id]));
            });
    }
}
