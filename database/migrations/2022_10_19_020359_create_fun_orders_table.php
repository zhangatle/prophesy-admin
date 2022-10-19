<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable()->comment('用户id');
            $table->string('order_no')->nullable()->comment('订单编号');
            $table->integer('activity_id')->nullable()->comment('活动id');
            $table->string('activity_name')->nullable()->comment('活动名称');
            $table->string('username')->nullable()->comment('用户昵称');
            $table->string('mobile')->nullable()->comment('电话');
            $table->decimal('actual_price')->nullable()->comment('金额');
            $table->integer('channel')->nullable()->comment('渠道');
            $table->dateTime('payment_time')->nullable()->comment('支付时间');
            $table->tinyInteger('status')->nullable()->comment('支付状态(0待支付，已支付)');
            $table->integer('chip_num')->nullable()->comment('碎片数');
            $table->dateTime('create_time')->nullable()->comment('创建时间');
            $table->dateTime('delete_time')->nullable()->comment('删除时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_orders');
    }
}
