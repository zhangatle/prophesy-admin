<?php

namespace App\Admin\Controllers;

use App\Models\Synthetic;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SyntheticController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $build = Synthetic::with(["goods"]);
        return Grid::make($build, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('url')->image("", "50", "50");
            $grid->column('goods', '已合成数')->display(function ($marketing) {
                return count($marketing);
            });
            $grid->column('need_chip_num');
            $grid->column('status')->using([1=>'可流通', 0=>'不可流通']);
            $grid->column('synthetic_status')->using([1=>'可合成', 0=>'不可合成']);
            $grid->column('create_time');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name');
            });

            $grid->actions(function (Grid\Displayers\Actions $actions){
                if(count($actions->row->goods) > 0) {
                    $actions->disableEdit();
                }
            });

            $grid->disableDeleteButton();
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
        return Show::make($id, new Synthetic(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('url')->image();
            $show->field('need_chip_num');
            $show->field('detail')->image();
            $show->field('status');
            $show->field('synthetic_status');
            $show->field('create_time');
            $show->disableEditButton();
            $show->disableDeleteButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Synthetic(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->image('url')->autoUpload()->required();
            $form->text('need_chip_num')->required();
            $form->text('first_price')->required();
            $form->multipleImage("detail", '活动详情')->saving(function ($paths) {
                return json_encode($paths);
            })->autoUpload()->uniqueName()->required();
            $form->radio("status")->options(["1" => '可流通', "0"=> '不可流通'])->required();
            $form->radio("synthetic_status")->options(["1" => '可合成', "0"=> '不可合成'])->required();

            $form->footer(function ($footer) {
                // 去掉`重置`按钮
                $footer->disableReset();
                // 去掉`查看`checkbox
                $footer->disableViewCheck();
                // 去掉`继续编辑`checkbox
                $footer->disableEditingCheck();
                // 去掉`继续创建`checkbox
                $footer->disableCreatingCheck();
            });
            $form->disableDeleteButton();
            $form->disableViewButton();
        });
    }
}
