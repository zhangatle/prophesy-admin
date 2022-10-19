<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples\ProductOrders;
use App\Admin\Module\MemberData;
use App\Admin\Module\MemberDetail;
use App\Admin\Repositories\Member;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;
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
        return Grid::make(new Member(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('upper_id');
            $grid->column('username');
            $grid->column('mobile');
            $grid->column('first_consume');
            $grid->column('chip_num');
            $grid->column('chip_total');
            $grid->column('last_login');
            $grid->column('avatar')->image("", 30, 30);
            $grid->column('level_id');
            $grid->column('status')->switch('', true);;
            $grid->column('promo_code');
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
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Member(), function (Show $show) {
            $show->field('id');
            $show->field('mobile');
            $show->field('username');
            $show->field('realname');
            $show->field('first_consume');
            $show->field('chip_num');
            $show->field('upper_id');
            $show->field('password');
            $show->field('birthday');
            $show->field('address_id');
            $show->field('last_login');
            $show->field('login_num');
            $show->field('last_ip');
            $show->field('avatar');
            $show->field('level_id');
            $show->field('status');
            $show->field('token');
            $show->field('promo_code');
            $show->field('create_time');
            $show->field('update_time');
            $show->field('delete_time');
            $show->field('rate');
            $show->field('chip_total');
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
            ->description('详情')
            ->body(function (Row $row) use ($id) {
                $row->column(3, new MemberDetail(['id' =>$id]));

                $row->column(9, new MemberData(['id'=>$id]));
            });
    }
}
