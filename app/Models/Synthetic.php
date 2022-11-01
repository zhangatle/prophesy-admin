<?php

namespace App\Models;

class Synthetic extends Model
{
    protected $table = 'fun_synthetic';

    /**
     * 合成物
     */
    public function goods() {
        return $this->hasMany(Good::class, 'synthetic_id', 'id');
    }

}
