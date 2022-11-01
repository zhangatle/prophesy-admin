<?php

namespace App\Admin\Controllers;

use App\Admin\Module\ResultDetail;
use App\Admin\Repositories\Activity;
use App\Admin\RowActions\PFAction;
use App\Models\ActivityDetail;
use App\Models\ActivityResult;
use Carbon\Carbon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\JsonResponse;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
//                if(count($result) == 0) {
//                    // append一个操作
//                    $actions->append(new PFAction());
//                }
                $actions->append(new PFAction());
            });
            $grid->disableDeleteButton();
            $grid->disableRowSelector();
            $grid->disableFilterButton();
            $grid->disableEditButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new \App\Models\Activity(), function (Form $form) {
            $play1_options = $form->model()->play1_options;
            $form->radio("play1", "A 猜谁会赢")->options($play1_options);
            $form->hidden("play1_id");

            $play2_options = $form->model()->play2_options;
            $form->radio("play2", "B 加大难度猜一下主".$form->model()->play2_zr)->options($play2_options);
            $form->hidden("play2_id");


            $play5_options = $form->model()->play5_options;
            $form->radio("play5", "C 猜范围")->options($play5_options);
            $form->hidden("play5_id");


            $play3_options = $form->model()->play3_options;
            $form->radio("play3", "D 你觉得整场能进几个球")->options($play3_options);
            $form->hidden("play3_id");


            $play4_options = $form->model()->play4_options;
            $form->radio("play4", "E 预言比分")->options($play4_options);
            $form->hidden("play4_id");


            if($form->isCreating()){
                $form->action('result/save');
            }else{
                $form->action('result/save/' . $form->getKey());
            }

            $form->disableDeleteButton();
            $form->disableViewButton();
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
        });
    }

    /**
     * 编辑页面
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        $activity = $this->form()->edit($id);
        $activity_result = ActivityResult::query()->where("activity_id", $id)->get()->toArray();
        $ac_result = [];
        foreach ($activity_result as $result) {
            $ac_result[$result["type"]] = ["win_key"=>$result["win_key"], "id"=>$result["id"]];
        }
        $activity_detail = ActivityDetail::query()->where("activity_id", $id)->get()->toArray();
        foreach ($activity_detail as $item) {
            if($item["type"] == 1) {
                $values = json_decode($item["values"], true);
                $win_key = $ac_result[$item["type"]]["win_key"] ?? null;
                $result_id = $ac_result[$item["type"]]["id"] ?? null;
                $activity->model()->setAttribute("play1_options", ["zs"=>"主胜,得".$values["zs"]."碎片", "p"=>"平,得".$values["p"]."碎片", "zf"=>"主负,得".$values["zf"]."碎片"]);
                $activity->model()->setAttribute("play1_id", $result_id);
                $activity->model()->setAttribute("play1", $win_key);
            }elseif($item["type"] == 2) {
                $values = json_decode($item["values"], true);
                $win_key = $ac_result[$item["type"]]["win_key"] ?? null;
                $result_id = $ac_result[$item["type"]]["id"] ?? null;
                $activity->model()->setAttribute("play2_options", ["zs"=>"主胜,得".$values["zs"]."碎片", "p"=>"平,得".$values["p"]."碎片", "zf"=>"主负,得".$values["zf"]."碎片"]);
                $activity->model()->setAttribute("play2_id", $result_id);
                $activity->model()->setAttribute("play2_zr", $values["zr"]);
                $activity->model()->setAttribute("play2", $win_key);
            }
            elseif($item["type"] == 3) {
                $values = json_decode($item["values"], true);
                $win_key = $ac_result[$item["type"]]["win_key"] ?? null;
                $result_id = $ac_result[$item["type"]]["id"] ?? null;
                $activity->model()->setAttribute("play3_options", [
                    "0"=> '0,得' . $values["0"] . "碎片",
                    "1"=>'1,得' . $values["1"] . "碎片",
                    "2"=>'2,得' . $values["2"] . "碎片",
                    "3"=>'3,得' . $values["3"] . "碎片",
                    "4"=>'4,得' . $values["4"] . "碎片",
                    "5"=>'5,得' . $values["5"] . "碎片",
                    "6"=>'6,得' . $values["6"] . "碎片",
                    "7plus"=>'7+,得' . $values["7+"] . "碎片",
                ]);
                $activity->model()->setAttribute("play3_id", $result_id);
                $activity->model()->setAttribute("play3", $win_key);
            }elseif($item["type"] == 4){
                $values = json_decode($item["values"], true);
                $win_key = $ac_result[$item["type"]]["win_key"] ?? null;
                $result_id = $ac_result[$item["type"]]["id"] ?? null;
                $p4_options = [];
                foreach ($values as $key => $value) {
                    $p4_options[$key] = "比分$key, 得$value"."碎片";
                }
                $activity->model()->setAttribute("play4_options", $p4_options);
                $activity->model()->setAttribute("play4_id", $result_id);
                $activity->model()->setAttribute("play4", $win_key);
            }else{
                $values = json_decode($item["values"], true);
                $win_key = $ac_result[$item["type"]]["win_key"] ?? null;
                $result_id = $ac_result[$item["type"]]["id"] ?? null;
                $activity->model()->setAttribute("play5_options", ["gt"=>"进球数大于".$values["sc"] .",得".$values['gt'] . '碎片', "lt"=>"进球数小于".$values["sc"].",得".$values['lt'] . '碎片']);
                $activity->model()->setAttribute("play5_id", $result_id);
                $activity->model()->setAttribute("play5", $win_key);
            }
        }
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['edit'] ?? trans('admin.edit'))
            ->body($activity);
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

    /**
     * Store a newly created resource in storage.
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function doUpdate($id, Request $request): mixed
    {
        $play1 = $request->input("play1");
        $play2 = $request->input("play2");
        $play3 = $request->input("play3");
        $play4 = $request->input("play4");
        $play5 = $request->input("play5");
        $play1_id = $request->input("play1_id");
        $play2_id = $request->input("play2_id");
        $play3_id = $request->input("play3_id");
        $play4_id = $request->input("play4_id");
        $play5_id = $request->input("play5_id");

        if($play1 && $play2 && $play3 && $play4 && $play5) {
            if($play1_id && $play2_id && $play3_id && $play4_id && $play5_id) {
                DB::beginTransaction();
                try {
                    ActivityResult::query()->where("activity_id", $id)->where("id", $play1_id)->update(["win_key"=>$play1]);
                    ActivityResult::query()->where("activity_id", $id)->where("id", $play2_id)->update(["win_key"=>$play2]);
                    ActivityResult::query()->where("activity_id", $id)->where("id", $play3_id)->update(["win_key"=>$play3]);
                    ActivityResult::query()->where("activity_id", $id)->where("id", $play4_id)->update(["win_key"=>$play4]);
                    ActivityResult::query()->where("activity_id", $id)->where("id", $play5_id)->update(["win_key"=>$play5]);
                    DB::commit();
                    return JsonResponse::make()->success('提交成功！')->redirect("result");
                }catch (\Exception $e) {
                    Log::error($e->getMessage());
                    DB::rollBack();
                    return JsonResponse::make()->error("参数错误");
                }
            }else {
                DB::beginTransaction();
                try {
                    ActivityResult::query()->insert(["activity_id"=>$id, "type"=>1, "win_key"=>$play1, "create_time"=>Carbon::now(), "update_time"=>Carbon::now()]);
                    ActivityResult::query()->insert(["activity_id"=>$id, "type"=>2, "win_key"=>$play2, "create_time"=>Carbon::now(), "update_time"=>Carbon::now()]);
                    ActivityResult::query()->insert(["activity_id"=>$id, "type"=>3, "win_key"=>$play3, "create_time"=>Carbon::now(), "update_time"=>Carbon::now()]);
                    ActivityResult::query()->insert(["activity_id"=>$id, "type"=>4, "win_key"=>$play4, "create_time"=>Carbon::now(), "update_time"=>Carbon::now()]);
                    ActivityResult::query()->insert(["activity_id"=>$id, "type"=>5, "win_key"=>$play5, "create_time"=>Carbon::now(), "update_time"=>Carbon::now()]);
                    DB::commit();
                    return JsonResponse::make()->success('提交成功！')->redirect("result");
                }catch (\Exception $e) {
                    Log::error($e->getMessage());
                    DB::rollBack();
                    return JsonResponse::make()->error("参数错误");
                }
            }
        }else{
            return JsonResponse::make()->error("参数错误");
        }
    }
}
