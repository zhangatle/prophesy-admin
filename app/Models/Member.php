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

    public function downer() {
        return $this->hasMany(Member::class, "upper_id", "id");
    }

    public function marketing() {
        return $this->hasMany(MemberMarketing::class, "member_id", "id");
    }
}
