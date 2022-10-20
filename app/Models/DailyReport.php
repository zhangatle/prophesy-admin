<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_daily_report';
    public $timestamps = false;

}
