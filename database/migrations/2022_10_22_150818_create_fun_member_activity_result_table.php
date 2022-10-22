<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunMemberActivityResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_member_activity_result', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->integer('activity_id')->nullable();
            $table->integer('chip_num')->nullable()->comment('碎片数量');
            $table->dateTime('update_time')->default('CURRENT_TIMESTAMP')->nullable()->comment('更新时间');
            $table->dateTime('create_time')->nullable();
            $table->string('goods_name')->nullable()->comment('商品名称');
            $table->decimal('goods_price')->nullable()->comment('商品价格');
            $table->string('activity_name')->nullable()->comment('活动名称');
            $table->string('status')->default('1')->nullable()->comment('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_member_activity_result');
    }
}
