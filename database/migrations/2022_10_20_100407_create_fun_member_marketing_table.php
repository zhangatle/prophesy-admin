<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunMemberMarketingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_member_marketing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->comment('原用户id');
            $table->integer('invite_member_id')->comment('被邀请用户的id');
            $table->string('order_id')->default('')->comment('订单id');
            $table->decimal('rate')->nullable()->comment('分润比例');
            $table->decimal('rate_price')->nullable()->comment('分润金额');
            $table->decimal('cur_price')->nullable()->comment('当前奖金');
            $table->dateTime('create_time')->nullable()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_member_marketing');
    }
}
