<?php

namespace App\Admin\Controllers;

use App\Admin\Module\MarketingDetail;
use App\Admin\Repositories\Member;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;

class PromoController extends AdminController
{
    protected $translation = 'promo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Member(['upper', 'downer', 'marketing']), function (Grid $grid) {
            $grid->model()->whereNotNull("first_consume");
            $grid->column('id')->sortable();
            $grid->column('upper.mobile', '上级手机号');
            $grid->column('username');
            $grid->column('mobile');
            $grid->column('downer', '所有下级首发消费额')->display(function ($downer) {
                return array_sum(array_column($downer->toArray(), "first_consume"));
            });
            $grid->column('marketing', '总奖金')->display(function ($marketing) {
                return array_sum(array_column($marketing->toArray(), "rate_price"));
            });
            $grid->column('wallet');
            $grid->column('create_time');

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
        });
    }

    public function show($id, Content $content)
    {
        return $content->header('推广用户')
            ->description('分润明细')
            ->body(Show::make($id, new Member(), function (Show $show) use($id) {
                $show->disableDeleteButton();
                $show->disableEditButton();
                $show->html(new MarketingDetail(['id' =>$id]));
            }));
    }
}
