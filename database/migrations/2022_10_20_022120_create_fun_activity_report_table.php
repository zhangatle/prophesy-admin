<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunActivityReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_activity_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->nullable()->comment('活动ID');
            $table->string('sell_amount')->default('0.00')->comment('总销售额');
            $table->integer('chip_total')->default('0')->comment('派发总数');
            $table->string('sell_a')->default('0.00')->comment('A玩法销售额');
            $table->string('sell_b')->default('0.00')->comment('B玩法销售额');
            $table->string('sell_c')->default('0.00')->comment('C玩法销售额');
            $table->string('sell_d')->default('0.00')->comment('D玩法销售额');
            $table->string('chip_a')->default('0.00')->comment('A玩法派发总数');
            $table->string('chip_b')->default('0.00')->comment('B玩法派发总数');
            $table->string('chip_c')->default('0.00')->comment('C玩法派发总数');
            $table->string('chip_d')->default('0.00')->comment('D玩法派发总数');
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
        Schema::dropIfExists('fun_activity_report');
    }
}
