<?php

namespace App\Models;


class Activity extends Model
{
    protected $table = 'fun_activity';

    protected $fillable = ["name", "img_url", "detail", "swiper_imgs", "price", "start_time", "end_time", "status", "kt_status", "sort"];

    public function details() {
        return $this->hasMany(ActivityDetail::class);
    }

    public function result() {
        return $this->hasMany(ActivityResult::class, "activity_id", 'id');
    }

    public function member_result() {
        return $this->hasMany(MemberActivityResult::class, "activity_id", 'id');
    }
}
