<?php

namespace App\Admin\Controllers;

use App\Admin\Module\MarketingDetail;
use App\Admin\Module\MemberData;
use App\Admin\Module\MemberDetail;
use App\Admin\Module\ResultDetail;
use App\Admin\Repositories\Activity;
use App\Admin\Repositories\Member;
use App\Admin\Repositories\Order;
use App\Models\ActivityResult;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class ResultController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $build = Activity::with(["result", "member_result"]);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('name');
            $grid->column('member_result', '派发总数')->display(function ($member_result) {
                return array_sum(array_column($member_result->toArray(), "chip_num"));
            });
            $grid->column('end_time', '活动结束时间');
            $grid->column('result', '派发时间')->display(function ($result) {
                return $result[0]['create_time'] ?? "";
            });
            $grid->column('status')->using([0 => '未派发', 1 => '已派发']);;

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like("name")->width(2);
                $filter->between("start_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '开启', '0' => '关闭'])->width(2);
            });
            $grid->actions(function (Grid\Displayers\Actions $actions){
                $result = $actions->row->result;
                if(count($result) > 0) {
                    $actions->disableEdit();
                }
            });
            $grid->disableDeleteButton();
            $grid->disableRowSelector();
            $grid->disableFilterButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Activity(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->image('img_url')->autoUpload();
            $form->multipleImage("detail", '活动详情')->saving(function ($paths) {
                return json_encode($paths);
            })->autoUpload()->uniqueName();
            $form->datetimeRange('start_time', 'end_time', '时间范围');
            $form->text('price');
            $form->text('status');
            $form->text('kt_status');
            $form->text('sort');
        });
    }

    /**
     * 详情
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content) {
        return $content->header('活动空投')
            ->body(Show::make($id, new \App\Models\Activity(), function (Show $show) use($id) {
                $show->disableDeleteButton();
                $show->disableEditButton();
                $show->html(new ResultDetail(['id' =>$id]));
            }));
    }
}
