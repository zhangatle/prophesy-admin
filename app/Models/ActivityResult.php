<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ActivityResult extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_activity_result';
    public $timestamps = false;

}
