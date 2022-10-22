<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_member';
    public $timestamps = false;

    protected $fillable = ["status"];

    public function upper() {
        return $this->belongsTo(Member::class, "upper_id", "id");
    }

}
