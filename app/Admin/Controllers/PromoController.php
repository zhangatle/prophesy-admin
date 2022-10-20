<?php

namespace App\Admin\Controllers;

use App\Admin\Module\MarketingDetail;
use App\Admin\Module\MemberData;
use App\Admin\Module\MemberDetail;
use App\Admin\Repositories\Member;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;

class PromoController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Member(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('upper_id');
            $grid->column('username');
            $grid->column('mobile');
            $grid->column('first_consume');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal("mobile")->width(2);
                $filter->between("create_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '开启', '0' => '关闭'])->width(2);
            });

            $grid->model()->orderBy("create_time", "desc");
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
            $grid->disableEditButton();
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
            $form->text('level_id');
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
        return $content->header('Member')
            ->description('分润明细')
            ->body(function (Row $row) use ($id) {
                $row->column(12, new MarketingDetail(['id' =>$id]));
            });
    }
}
