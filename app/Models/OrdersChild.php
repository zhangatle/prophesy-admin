<?php

namespace App\Models;

class OrdersChild extends Model
{
    protected $table = 'fun_orders_child';

    public function activity() {
        return $this->belongsTo(Activity::class);
    }

}
