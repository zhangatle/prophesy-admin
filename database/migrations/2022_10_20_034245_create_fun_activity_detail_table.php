<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunActivityDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_activity_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->nullable()->comment('活动id');
            $table->tinyInteger('type')->comment('玩法类型：1猜谁会赢  2加大难度猜 3总数 4比分');
            $table->text('value')->comment('玩法内容：json：type=1(zs：主胜 p：平 zf:主负)type=2(zr:主让球   zs：主胜 p：平 zf:主负)type=3(总进球数:碎片数量)type=4(score:比分对象)');
            $table->string('key_map')->nullable()->comment('玩法key分类：json');
            $table->dateTime('create_time')->default('CURRENT_TIMESTAMP')->nullable()->comment('创建时间');
            $table->dateTime('update_time')->default('CURRENT_TIMESTAMP')->nullable()->comment('更新时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_activity_detail');
    }
}
