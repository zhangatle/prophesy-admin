<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasDateTimeFormatter;
    public $timestamps = true;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
