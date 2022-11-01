<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{

    protected $table = 'fun_member';
    protected $fillable = ["status"];

    // 上级
    public function upper(): BelongsTo
    {
        return $this->belongsTo(Member::class, "upper_id", "id");
    }

    // 钱包
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, "member_id", "id");
    }


    public function downer() {
        return $this->hasMany(Member::class, "upper_id", "id");
    }

    public function marketing() {
        return $this->hasMany(MemberMarketing::class, "member_id", "id");
    }
}
