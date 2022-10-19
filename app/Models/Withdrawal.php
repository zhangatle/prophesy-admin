<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_withdrawal';
    public $timestamps = false;

}
