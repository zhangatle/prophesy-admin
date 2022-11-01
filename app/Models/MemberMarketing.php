<?php

namespace App\Models;

class MemberMarketing extends Model
{
    protected $table = 'fun_member_marketing';

    protected $fillable = ["order_no"];

    public function order() {
        return $this->hasOne(Order::class, "order_no", "order_no");
    }

}
