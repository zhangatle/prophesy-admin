<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_goods';
    public $timestamps = false;

}
