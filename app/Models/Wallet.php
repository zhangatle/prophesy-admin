<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_wallet';

    protected $primaryKey = 'member_id';

    public $timestamps = false;

}
