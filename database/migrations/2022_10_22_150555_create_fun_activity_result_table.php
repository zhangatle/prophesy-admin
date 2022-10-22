<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunActivityResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_activity_result', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->comment('活动id');
            $table->tinyInteger('type')->comment('玩法类型：1猜谁会赢  2加大难度猜 3总数 4比分');
            $table->string('win_key')->default('')->comment('中奖类目：关键字');
            $table->dateTime('update_time')->default('CURRENT_TIMESTAMP')->nullable()->comment('更新时间');
            $table->dateTime('create_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_activity_result');
    }
}
