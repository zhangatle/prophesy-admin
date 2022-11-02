<?php

namespace App\Admin\RowActions;

use Dcat\Admin\Grid\RowAction;

class PFAction extends RowAction
{
    public function __construct($title = null)
    {
        parent::__construct($title);
    }

    /**
     * 返回字段标题
     *
     * @return string
     */
    public function title()
    {
        if($this->title == 2) {
            // 已派发的就不允许显示了
            return "";
        }else{
            return '派发';
        }
    }

    public function html()
    {
        // 获取当前行数据ID
        $id = $this->getKey();
        $this->setHtmlAttribute(['href'=>"/admin/result/$id/edit"]);
        return parent::html();
    }
}
