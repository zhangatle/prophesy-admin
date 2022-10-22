<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('synthetic_id')->nullable()->comment('合成方案id');
            $table->integer('member_id')->comment('会员id');
            $table->string('product_no')->nullable()->comment('商品编号');
            $table->string('name')->nullable()->comment('商品名称');
            $table->string('url')->nullable()->comment('商品主图');
            $table->tinyInteger('status')->default('0')->nullable()->comment('1可流通，0不可流通');
            $table->tinyInteger('type')->default('1')->nullable()->comment('类别(1球星卡，2碎片，3奖杯)');
            $table->tinyInteger('lock')->default('0')->nullable()->comment('商品状态，1锁定（挂载），0未锁定（购买完成）');
            $table->dateTime('create_time')->nullable();
            $table->dateTime('delete_time')->nullable()->comment('不为空表示已经删除');
            $table->string('order_no')->nullable()->comment('球星卡对应的订单号');
            $table->integer('number')->default('1')->comment('数量：球星卡为1个或者多个，奖杯默认一个');
            $table->string('keyword')->nullable()->comment('玩法标识');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_goods');
    }
}
