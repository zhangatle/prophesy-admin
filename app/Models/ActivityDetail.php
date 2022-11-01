<?php

namespace App\Models;

class ActivityDetail extends Model
{
    protected $table = 'fun_activity_detail';

    protected $fillable = ["type", "values", "img_url_map"];

    public function activity() {
        return $this->belongsTo(Activity::class);
    }
}
