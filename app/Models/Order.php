<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_orders';
    public $timestamps = false;

    const ORDER_WAIT_PAY = 0;
    const ORDER_PAID = 1;
    const ORDER_PAY_EXPIRE = 2;

    const KT_STATUS_NO = 0;
    const KT_STATUS_YES = 1;
    const KT_STATUS_SUCCESS = 2;

    const WIN_STATUS = 1;
    const NO_WIN_STATUS = 2;
    const WAIT_WIN_STATUS = 0;

    const OPEN_STATUS_NO = 0;
    const OPEN_STATUS_YES = 1;

    public function activity() {
        return $this->belongsTo(Activity::class);
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function child() {
        return $this->hasMany(OrdersChild::class, "order_no", "order_no");
    }

}
