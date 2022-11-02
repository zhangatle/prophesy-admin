<?php

namespace App\Admin\Controllers;

use App\Models\Activity;
use App\Models\ActivityDetail;
use Carbon\Carbon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\JsonResponse;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Traits\HasUploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActivityController extends AdminController
{
    use HasUploadedFile;
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Activity(), function (Grid $grid) {
            $grid->actions(function (Grid\Displayers\Actions $actions){
                $start_time = $actions->row->start_time;
                if($start_time < Carbon::now()) {
                    $actions->disableEdit();
                }
            });
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('img_url')->image("", "50", "50");
            $grid->column('detail')->display(function ($pictures) {
                return json_decode($pictures, true);
            })->image("", 50, 50);
            $grid->column('price');
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('status')->using([0 => '禁用', 1 => '启用']);;
            $grid->column('kt_status')->using([0 => '未空投', 1 => '已空投', '2'=>'已派发']);
            $grid->column('create_time');
            $grid->column('activity_status')->display(function () {
                if ($this->start_time > Carbon::now()) {
                    return "未开始";
                } elseif ($this->end_time < Carbon::now()) {
                    return "已结束";
                } else {
                    return "进行中";
                }
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like("name")->width(2);
                $filter->between("start_time")->datetime()->width(3);
                $filter->equal('status')->select(['1' => '开启', '0' => '关闭'])->width(2);
            });
            $grid->disableDeleteButton();
            $grid->disableRowSelector();
            $grid->disableViewButton();
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
            $form->tab('基础配置', function (Form $form) {
                $form->display('id');
                $form->text('name')->required()->maxLength(50);
                $form->image('img_url')->autoUpload()->url("image/upload")->required();
                $form->multipleImage("detail", '活动详情')->saving(function ($paths) {
                    return json_encode($paths);
                })->autoUpload()->url("image/upload")->required();
                $form->multipleImage("swiper_imgs", '轮播')->saving(function ($paths) {
                    return json_encode($paths);
                })->autoUpload()->url("image/upload")->required();
                $form->datetimeRange('start_time', 'end_time', '时间范围')->required();
                $form->text('price')->required();
                $form->radio("status")->options(["0" => '禁用', "1"=> '启用'])->default("0")->required();
                $form->radio('kt_status')->options(["0" => '未空投', "1"=> '已空投', "2"=>"已派发"])->default("0")->required();
                $form->text('sort')->required();
            })->tab("猜谁会赢", function ($form) {
                if($form->isEditing()) {
                    $form->hidden("play1_id");
                }
                $form->embeds('play1', '猜谁会赢', function (Form\EmbeddedForm $form) {
                    $form->text('zs', '主胜')->type("number")->required();
                    $form->image('zs_img', '主胜详情')->required()->autoUpload()->url("image/upload");
                    $form->text('p', '平')->type("number")->required();
                    $form->image('p_img', '平详情')->required()->autoUpload()->url("image/upload");
                    $form->text('zf', '主负')->type("number")->required();
                    $form->image('zf_img', '主负详情')->required()->autoUpload()->url("image/upload");
                })->saving(function ($v) {
                    return json_encode($v);
                });
            })->tab("加大难度猜", function ($form) {
                if($form->isEditing()) {
                    $form->hidden("play2_id");
                }
                $form->embeds('play2', '加大难度猜', function (Form\EmbeddedForm $form) {
                    $form->text('zr', '主让')->type("number")->required();
                    $form->text('zs', '主胜')->type("number")->required();
                    $form->image('zs_img', '主胜详情')->required()->autoUpload()->url("image/upload");
                    $form->text('p', '平')->type("number")->required();
                    $form->image('p_img', '平详情')->required()->autoUpload()->url("image/upload");
                    $form->text('zf', '主负')->type("number")->required();
                    $form->image('zf_img', '主负详情')->required()->autoUpload()->url("image/upload");
                })->saving(function ($v) {
                    return json_encode($v);
                });
            })->tab("整场进球数", function ($form) {
                if($form->isEditing()) {
                    $form->hidden("play3_id");
                }
                $form->embeds('play3', '整场进球数', function (Form\EmbeddedForm $form) {
                    $form->text('0')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p0', '详情')->autoUpload()->required()->url("image/upload");
                    $form->text('1')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p1', '详情')->autoUpload()->required()->url("image/upload");
                    $form->text('2')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p2', '详情')->autoUpload()->required()->url("image/upload");
                    $form->text('3')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p3', '详情')->autoUpload()->required()->url("image/upload");
                    $form->text('4')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p4', '详情')->autoUpload()->required()->url("image/upload");
                    $form->text('5')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p5', '详情')->autoUpload()->required()->url("image/upload");
                    $form->text('6')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p6', '详情')->autoUpload()->required()->url("image/upload");
                    $form->text('7plus')->placeholder("请输入碎片值")->required()->type("number");
                    $form->image('p7plus', '详情')->autoUpload()->required()->url("image/upload");
                })->saving(function ($v) {
                    return json_encode($v);
                });
            })->tab("预言比分", function ($form) {
                if($form->isEditing()) {
                    $form->hidden("play4_id");
                }
                $form->table('play4', '预言比分', function ($table) {
                    $table->text('score', '比分')->required()->pattern("\d{1,}-\d{1,}");
                    $table->text('chip', '碎片')->type("number")->required();
                    $table->image('pic', '详情')->autoUpload()->url("image/upload")->required();
                })->saving(function ($v) {
                    return json_encode($v);
                });
            })->tab("猜进球范围", function ($form) {
                if($form->isEditing()) {
                    $form->hidden("play5_id");
                }
                $form->embeds('play5', '猜进球范围', function (Form\EmbeddedForm $form) {
                    $form->text('sc', '数量')->pattern("^\d+(\.\d{1})?$")->required();
                    $form->text('gt', '猜进球大于')->type("number")->required();
                    $form->image('gt_img', '详情')->required()->autoUpload()->url("image/upload");
                    $form->text('lt', '猜进球小于')->type("number")->required();
                    $form->image('lt_img', '详情')->required()->autoUpload()->url("image/upload");
                })->saving(function ($v) {
                    return json_encode($v);
                });
            });

            if($form->isCreating()){
                $form->action('activity/save');
            }else{
                $form->action('activity/save/' . $form->getKey());
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
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function doUpdate($id, Request $request)
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

        $swiper_imgs = $request->input("swiper_imgs") ? json_encode(explode(",", $request->input("swiper_imgs"))) : null;
        $detail = $request->input("detail") ? json_encode(explode(",", $request->input("detail"))) : null;
        $request->offsetSet("swiper_imgs", $swiper_imgs);
        $request->offsetSet("detail", $detail);

        if($play1 && $play2 && $play3 && $play4 && $play5) {
            // 玩法1
            $play1 = [
                "values"=>json_encode(["zs"=>$play1["zs"], "p"=>$play1["p"], "zf"=>$play1["zf"]]),
                "img_url_map"=>json_encode(["zs"=>$play1["zs_img"], "p"=>$play1["p_img"], "zf"=>$play1["zf_img"]])
            ];

            $play2 = [
                "values"=>json_encode(["zr"=>$play2["zr"],"zs"=>$play2["zs"], "p"=>$play2["p"], "zf"=>$play2["zf"]]),
                "img_url_map"=>json_encode(["zs"=>$play2["zs_img"], "p"=>$play2["p_img"], "zf"=>$play2["zf_img"]])
            ];

            $play3 = [
                "values"=>json_encode(["0"=>$play3["0"], "1"=>$play3["1"], "2"=>$play3["2"], "3"=>$play3["3"], "4"=>$play3["4"],"5"=>$play3["5"], "6"=>$play3["6"],"7+"=>$play3["7plus"]]),
                "img_url_map"=>json_encode(["0"=>$play3["p0"], "1"=>$play3["p1"], "2"=>$play3["p2"], "3"=>$play3["p3"], "4"=>$play3["p4"],"5"=>$play3["p5"], "6"=>$play3["p6"],"7+"=>$play3["p7plus"]]),
            ];

            $play4_values = $play4_img_map = [];
            foreach ($play4 as $item) {
                $play4_values[$item["score"]] = $item["chip"];
                $play4_img_map[$item["score"]] = $item["pic"];
            }
            $play4 = [
                "values"=>json_encode($play4_values),
                "img_url_map"=>json_encode($play4_img_map),
            ];
            $play5 = [
                "values"=>json_encode(["sc"=>$play5["sc"], "gt"=>$play5["gt"], "lt"=>$play5["lt"]]),
                "img_url_map"=>json_encode(["gt"=>$play5["gt_img"], "lt"=>$play5["lt_img"]])
            ];
            DB::beginTransaction();
            try {
                ActivityDetail::query()->where("id", $play1_id)->update($play1);
                ActivityDetail::query()->where("id", $play2_id)->update($play2);
                ActivityDetail::query()->where("id", $play3_id)->update($play3);
                ActivityDetail::query()->where("id", $play4_id)->update($play4);
                ActivityDetail::query()->where("id", $play5_id)->update($play5);
                Activity::query()->where("id", $id)->update($request->only(["name", "img_url", "detail", "swiper_imgs", "price", "start_time", "end_time", "status", "kt_status", "sort"]));
                DB::commit();
                return JsonResponse::make()->success('提交成功！')->redirect("activity");
            }catch (\Exception $e) {
                Log::error($e->getMessage());
                DB::rollBack();
                return JsonResponse::make()->error("参数错误");
            }
        }else{
            return JsonResponse::make()->error("参数错误");
        }
    }

    /**
     * 新增活动数据
     * @param Request $request
     * @return JsonResponse
     */
    public function doCreate(Request $request) {
        $play1 = $request->input("play1");
        $play2 = $request->input("play2");
        $play3 = $request->input("play3");
        $play4 = $request->input("play4");
        $play5 = $request->input("play5");
        if(!$play1 || !$play2 || !$play3 || !$play4 || !$play5) {
            return JsonResponse::make()->error("参数错误");
        }
        $play4_values = $play4_img_map = [];
        foreach ($play4 as $item) {
            $play4_values[$item["score"]] = $item["chip"];
            $play4_img_map[$item["score"]] = $item["pic"];
        }

        $swiper_imgs = $request->input("swiper_imgs") ? json_encode(explode(",", $request->input("swiper_imgs"))) : null;
        $detail = $request->input("detail") ? json_encode(explode(",", $request->input("detail"))) : null;
        $request->offsetSet("swiper_imgs", $swiper_imgs);
        $request->offsetSet("detail", $detail);

        // 判断是新增还是编辑
        DB::transaction(function () use ($play1, $play2, $play3, $play4_values, $play4_img_map, $request) {
            $activity = new Activity();
            $activity->fill($request->all());
            $activity->save();
            $activity_id = $activity->id;
            $play1 = [
                "type" => 1,
                "activity_id"=>$activity_id,
                "values"=>json_encode(["zs"=>$play1["zs"], "p"=>$play1["p"], "zf"=>$play1["zf"]]),
                "img_url_map"=>json_encode(["zs"=>$play1["zs_img"], "p"=>$play1["p_img"], "zf"=>$play1["zf_img"]])
            ];
            $play2 = [
                "type" => 2,
                "activity_id"=>$activity_id,
                "values"=>json_encode(["zr"=>$play2["zr"],"zs"=>$play2["zs"], "p"=>$play2["p"], "zf"=>$play2["zf"]]),
                "img_url_map"=>json_encode(["zs"=>$play2["zs_img"], "p"=>$play2["p_img"], "zf"=>$play2["zf_img"]])
            ];

            $play3 = [
                "type" => 3,
                "activity_id"=>$activity_id,
                "values"=>json_encode(["0"=>$play3["0"], "1"=>$play3["1"], "2"=>$play3["2"], "3"=>$play3["3"], "4"=>$play3["4"],"5"=>$play3["5"], "6"=>$play3["6"],"7+"=>$play3["7plus"]]),
                "img_url_map"=>json_encode(["0"=>$play3["p0"], "1"=>$play3["p1"], "2"=>$play3["p2"], "3"=>$play3["p3"], "4"=>$play3["p4"],"5"=>$play3["p5"], "6"=>$play3["p6"],"7+"=>$play3["p7plus"]]),
            ];

            $play4 = [
                "type" => 4,
                "activity_id"=>$activity_id,
                "values"=>json_encode($play4_values),
                "img_url_map"=>json_encode($play4_img_map),
            ];
            $play5 = [
                "type" => 5,
                "activity_id"=>$activity_id,
                "values"=>json_encode(["sc"=>$play1["sc"], "gt"=>$play1["gt"], "lt"=>$play1["lt"]]),
                "img_url_map"=>json_encode(["gt"=>$play1["gt_img"], "lt"=>$play1["lt_img"]])
            ];
            ActivityDetail::query()->insert($play1);
            ActivityDetail::query()->insert($play2);
            ActivityDetail::query()->insert($play3);
            ActivityDetail::query()->insert($play4);
            ActivityDetail::query()->insert($play5);

        });
        return JsonResponse::make()->success('提交成功！')->redirect("activity");
    }


    public function uploadImg()
    {
        $disk = $this->disk('oss');

        // 判断是否是删除文件请求
        if ($this->isDeleteRequest()) {
            // 删除文件并响应
            return $this->deleteFileAndResponse($disk);
        }
        // 获取上传的文件
        $file = $this->file();

        $dir = 'prophesy';
        $newName = md5(uniqid()).'.'.$file->getClientOriginalExtension();

        $result = $disk->putFileAs($dir, $file, $newName);

        $path = "{$dir}/$newName";

        return $result
            ? $this->responseUploaded($path, $disk->url($path))
            : $this->responseErrorMessage('文件上传失败');
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
        $activity_detail = ActivityDetail::query()->where("activity_id", $id)->get()->toArray();
        foreach ($activity_detail as $item) {
            if($item["type"] == 1) {
                $values = json_decode($item["values"], true);
                $img_url_map = json_decode($item["img_url_map"], true);
                $activity->model()->setAttribute("play1", ["zs"=>$values["zs"], "p"=>$values["p"], "zf"=>$values["zf"], "zs_img"=>$img_url_map["zs"], "p_img"=>$img_url_map["p"], "zf_img"=>$img_url_map["zf"]]);
                $activity->model()->setAttribute("play1_id", $item["id"]);
            }elseif($item["type"] == 2) {
                $values = json_decode($item["values"], true);
                $img_url_map = json_decode($item["img_url_map"], true);
                $activity->model()->setAttribute("play2", ["zr"=>$values["zr"],"zs"=>$values["zs"], "p"=>$values["p"], "zf"=>$values["zf"], "zs_img"=>$img_url_map["zs"], "p_img"=>$img_url_map["p"], "zf_img"=>$img_url_map["zf"]]);
                $activity->model()->setAttribute("play2_id", $item["id"]);
            }
            elseif($item["type"] == 3) {
                $values = json_decode($item["values"], true);
                $img_url_map = json_decode($item["img_url_map"], true);
                $activity->model()->setAttribute("play3", [
                    "0"=>$values["0"],
                    "1"=>$values["1"],
                    "2"=>$values["2"],
                    "3"=>$values["3"],
                    "4"=>$values["4"],
                    "5"=>$values["5"],
                    "6"=>$values["6"],
                    "7plus"=>$values["7+"],

                    "p0"=>$img_url_map["0"],
                    "p1"=>$img_url_map["1"],
                    "p2"=>$img_url_map["2"],
                    "p3"=>$img_url_map["3"],
                    "p4"=>$img_url_map["4"],
                    "p5"=>$img_url_map["5"],
                    "p6"=>$img_url_map["6"],
                    "p7plus"=>$img_url_map["7+"],
                ]);
                $activity->model()->setAttribute("play3_id", $item["id"]);
            }elseif($item["type"] == 4){
                $values = json_decode($item["values"], true);
                $img_url_map = json_decode($item["img_url_map"], true);
                $play4 = [];
                foreach ($values as $k4 => $v4) {
                    $play4[] = ["score"=>$k4, "chip"=>$v4, "pic"=>$img_url_map[$k4]];
                }
                $activity->model()->setAttribute("play4", $play4);
                $activity->model()->setAttribute("play4_id", $item["id"]);
            }else{
                $values = json_decode($item["values"], true);
                $img_url_map = json_decode($item["img_url_map"], true);
                $activity->model()->setAttribute("play5", ["sc"=>$values["sc"], "gt"=>$values["gt"], "lt"=>$values["lt"], "gt_img"=>$img_url_map["gt"], "lt_img"=>$img_url_map["lt"]]);
                $activity->model()->setAttribute("play5_id", $item["id"]);
            }
        }
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['edit'] ?? trans('admin.edit'))
            ->body($activity);
    }

}
