<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Synthetic extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_synthetic';
    public $timestamps = false;

}
