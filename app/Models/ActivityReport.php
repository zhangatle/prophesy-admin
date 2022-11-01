<?php

namespace App\Models;

class ActivityReport extends Model
{
    protected $table = 'fun_activity_report';

    public function activity() {
        return $this->belongsTo(Activity::class, "activity_id", "id");
    }
}
