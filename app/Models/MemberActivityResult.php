<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class MemberActivityResult extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_member_activity_result';
    public $timestamps = false;

}
