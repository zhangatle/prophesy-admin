<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('活动名称');
            $table->string('img_url')->nullable()->comment('主图');
            $table->text('detail')->nullable()->comment('详情（图片地址,逗号隔开）');
            $table->integer('price')->nullable()->comment('价格：单位分');
            $table->integer('start_time')->comment('开始时间');
            $table->integer('end_time')->comment('结束时间');
            $table->tinyInteger('status')->nullable()->comment('状态');
            $table->tinyInteger('kt_status')->nullable()->comment('状态');
            $table->integer('sort')->nullable()->comment('排序值：大的排前面');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_activity');
    }
}
