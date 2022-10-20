<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class OrdersChild extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_orders_child';
    public $timestamps = false;

    public function activity() {
        return $this->belongsTo(Activity::class);
    }

}
