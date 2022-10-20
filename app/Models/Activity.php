<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_activity';
    public $timestamps = false;

    public function details() {
        return $this->hasMany(ActivityDetail::class);
    }
}
