<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_transition';
    public $timestamps = false;

}
