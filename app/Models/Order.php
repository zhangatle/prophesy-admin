<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_orders';
    public $timestamps = false;

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
