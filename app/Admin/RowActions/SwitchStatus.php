<?php

namespace App\Admin\RowActions;

use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;

/**
 * 编辑status字段
 */
class SwitchStatus extends RowAction
{
    protected $model;

    public function __construct(string $model = null)
    {
        $this->model = $model;
    }

    /**
     * 标题
     *
     * @return string
     */
    public function title()
    {
        return $this->row->status == 1 ? '禁用' : '启用';
    }

    /**
     * 设置确认弹窗信息，如果返回空值，则不会弹出弹窗
     *
     * 允许返回字符串或数组类型
     *
     * @return array|string|void
     */
    public function confirm()
    {
        $status = $this->row->status == 1 ? '禁用' : '启用';
        return [
            // 确认弹窗 title
            "您确定要". $status ."该记录吗？",
            // 确认弹窗 content
//            $this->row->username,
        ];
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return \Dcat\Admin\Actions\Response
     */
    public function handle(Request $request)
    {
        // 获取当前行ID
        $id = $this->getKey();

        // 获取 parameters 方法传递的参数
        $status = $request->get('status');
        $model = $request->get('model');

        // 更新状态
        $model::find($id)->update(["status"=>$status]);

        // 返回响应结果并刷新页面
        return $this->response()->success("操作成功")->refresh();
    }

    /**
     * 设置要POST到接口的数据
     *
     * @return array
     */
    public function parameters()
    {
        return [
            // 发送当前行 username 字段数据到接口
            'status' => $this->row->status == 1 ? 0 : 1,
            // 把模型类名传递到接口
            'model' => $this->model,
        ];
    }
}
