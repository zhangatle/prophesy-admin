<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class MemberMarketing extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_member_marketing';
    public $timestamps = false;

}
