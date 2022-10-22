<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Synthetic extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'fun_synthetic';
//    public $timestamps = false;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * 合成物
     */
    public function goods() {
        return $this->hasMany(Good::class, 'synthetic_id', 'id');
    }

}
