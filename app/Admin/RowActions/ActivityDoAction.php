<?php

namespace App\Admin\RowActions;

use Dcat\Admin\Grid\RowAction;

class ActivityDoAction extends RowAction
{
    /**
     * 返回字段标题
     *
     * @return string
     */
    public function title()
    {
        return '查看&编辑';
    }

    public function html()
    {
        // 获取当前行数据ID
        $id = $this->getKey();
        $this->setHtmlAttribute(['href'=>"/admin/activity/$id/edit"]);
        return parent::html();
    }
}
