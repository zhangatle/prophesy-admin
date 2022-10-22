<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Withdrawal;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class WithdrawalController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $build = Withdrawal::with(["wallet"]);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('member_id');
            $grid->column('apply_name');
            $grid->column('apply_mobile');
            $grid->column('apply_price');
            $grid->column('account');
            $grid->column('wallet.total', '余额');
            $grid->column('status')->using([1=>'申请中', 2=>'已驳回', 3=>'已打款']);

            $grid->disableDeleteButton();
            $grid->disableViewButton();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
               $actions->append("<a class='feather icon-eye text-success' href='/admin/promo/$this->member_id'><span class='text-success'>查看分润</span></a>");
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal("apply_mobile")->width(2);
                $filter->equal("member_id")->width(2);
                $filter->between("create_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '申请中', '2' => '已驳回', '3'=>'已打款'])->width(2);
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Withdrawal(), function (Form $form) {
            $form->display('id');
            $form->text('member_id');
            $form->text('status');
        });
    }
}
