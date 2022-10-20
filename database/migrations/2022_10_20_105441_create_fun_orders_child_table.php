<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunOrdersChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_orders_child', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->default('')->comment('订单表的订单号');
            $table->integer('activity_id')->comment('活动id：为了统计方便');
            $table->tinyInteger('type')->default('1')->comment('活动玩法类型：1猜谁会赢  2加大难度猜 3总数 4比分');
            $table->string('keywork')->default('')->comment('玩法内容的关键字');
            $table->integer('number')->default('0')->comment('购买数据');
            $table->integer('chip_num')->default('0')->comment('中奖的碎片数量');
            $table->tinyInteger('status')->default('0')->comment('中奖状态：0待开  1中了  2未中');
            $table->decimal('price')->default('0.00')->comment('金额');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_orders_child');
    }
}
