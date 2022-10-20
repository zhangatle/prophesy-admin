<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunDailyReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_daily_report', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable()->comment('日期');
            $table->string('sell_amount')->default('0.00')->comment('总销售额');
            $table->integer('chip_total')->default('0')->comment('派发总数');
            $table->string('promo_amount')->default('0.00')->comment('支出推广金');
            $table->string('withdraw_amount')->default('0.00')->comment('提现金额');
            $table->dateTime('create_time')->nullable()->comment('创建时间');
            $table->dateTime('update_time')->nullable()->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_daily_report');
    }
}
