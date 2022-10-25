<?php

namespace App\Admin\Controllers;

use App\Models\Activity;
use App\Models\ActivityDetail;
use Carbon\Carbon;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\JsonResponse;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Traits\HasUploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
//            $grid->actions(function (Grid\Displayers\Actions $actions){
//                $start_time = $actions->row->start_time;
//                if($start_time < Carbon::now()) {
//                    $actions->disableEdit();
//                }
//            });

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
            $grid->column('kt_status')->using([0 => '未空投', 1 => '已空投']);
            $grid->column('create_time');
            $grid->column('activity_status')->display(function () {
                if ($this->start_time > Carbon::now()) {
                    return "未开始";
                } elseif ($this->end < Carbon::now()) {
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
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Activity(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('img_url');
            $show->field('detail');
            $show->field('price');
            $show->field('start_time');
            $show->field('end_time');
            $show->field('status');
            $show->field('kt_status');
            $show->field('sort');
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
            $form->column(12, function (Form $form) {

                $form->display('id');
                $form->text('name')->default("cc");
                $form->image('img_url')->autoUpload()->url("image/upload");
                $form->multipleImage("detail", '活动详情')->saving(function ($paths) {
                    return json_encode($paths);
                })->autoUpload()->uniqueName()->url("image/upload");
                $form->datetimeRange('start_time', 'end_time', '时间范围');
                $form->text('price')->default("1");
                $form->text('status')->default("1");
                $form->text('kt_status')->default("1");
                $form->text('sort')->default("1");
                $form->datetime("create_time")->default(Carbon::now());
                $form->datetime("update_time")->default("2022-10-20 10:54:27");

                $form->text("aa");
            });





            $form->column(12, function ( $form) {
                $form->embeds('play1', '玩法1', function ( $form) {
                    $form->text('zs', '主胜');
                    $form->image('zs_img', '主胜详情')->autoUpload()->uniqueName()->url("image/upload");
                    $form->text('p', '主胜');
                    $form->image('p_img', '平详情')->autoUpload()->uniqueName()->url("image/upload");
                    $form->text('zf', '主胜');
                    $form->image('zf_img', '主负详情')->autoUpload()->uniqueName()->url("image/upload");
                })->saving(function ($v) {
                    // 转化为json格式存储
                    return json_encode($v);
                });
            });

            $form->action('activity/save');
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function save(Request $request) {
        $play1 = $request->input("play1");
        $play1_id = $play1["id"] ?? null;
        $play1 = [
            "type"=>1,
            "activity_id"=>1,
            "values"=>json_encode(["zs"=>$play1["zs"], "p"=>$play1["p"], "zf"=>$play1["zf"]]),
            "img_url_map"=>json_encode(["zs"=>$play1["zs_img"], "p"=>$play1["p_img"], "zf"=>$play1["zf_img"]])
        ];
        DB::transaction(function () use ($play1_id, $play1) {
            if($play1_id) {
                ActivityDetail::query()->where("id", $play1_id)->update($play1);
            }else{
                ActivityDetail::query()->insert($play1);
            }
            $this->form()->ignore(["play1"])->store();
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
        $test = $this->form()->edit($id);
        $test->model()->setAttribute("play1", ["zs"=>1, "zs_img"=>"prophesy/images/071a1376b24a586c019104ec3c8e1033.jpg"]);
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['edit'] ?? trans('admin.edit'))
            ->body($test);
    }

}
