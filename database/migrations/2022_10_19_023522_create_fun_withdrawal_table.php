<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunWithdrawalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_withdrawal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable()->comment('用户id');
            $table->string('apply_name')->nullable()->comment('提现用户');
            $table->string('apply_mobile')->nullable()->comment('提现手机号');
            $table->decimal('apply_price')->nullable()->comment('提现价格');
            $table->string('account')->nullable()->comment('提现量');
            $table->tinyInteger('status')->nullable()->comment('1申请中，2已驳回，3已打款');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_withdrawal');
    }
}
