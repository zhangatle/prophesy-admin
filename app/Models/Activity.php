<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_activity';
    public $timestamps = true;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $fillable = ["name", "img_url", "detail", "price", "start_time", "end_time", "status", "kt_status", "sort"];

    public function details() {
        return $this->hasMany(ActivityDetail::class);
    }

    public function result() {
        return $this->hasMany(ActivityResult::class, "activity_id", 'id');
    }

    public function member_result() {
        return $this->hasMany(MemberActivityResult::class, "activity_id", 'id');
    }
}
