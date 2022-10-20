<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ActivityReport extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_activity_report';
    public $timestamps = false;

}