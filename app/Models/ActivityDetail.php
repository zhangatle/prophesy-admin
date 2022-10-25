<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ActivityDetail extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_activity_detail';
    public $timestamps = false;

    protected $fillable = ["type", "values", "img_url_map"];

    public function activity() {
        return $this->belongsTo(Activity::class);
    }
}
