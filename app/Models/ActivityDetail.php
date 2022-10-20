<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ActivityDetail extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_activity_detail';
    public $timestamps = false;

    protected $fillable = ["type", "values", "key_map"];

    public function activity() {
        return $this->belongsTo(Activity::class);
    }
}
