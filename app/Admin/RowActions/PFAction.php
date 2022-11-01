<?php

namespace App\Admin\RowActions;

use Dcat\Admin\Grid\RowAction;

class PFAction extends RowAction
{
    /**
     * 返回字段标题
     *
     * @return string
     */
    public function title()
    {
        return '派发';
    }

    public function html()
    {
        // 获取当前行数据ID
        $id = $this->getKey();
        $this->setHtmlAttribute(['href'=>"/admin/result/$id/edit"]);
        return parent::html();
    }
}
