<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunSyntheticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_synthetic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('合成商品名称');
            $table->string('url')->nullable()->comment('主图');
            $table->integer('need_chip_num')->nullable()->comment('所需碎片数量');
            $table->string('detail')->nullable()->comment('详情，图片列表');
            $table->tinyInteger('status')->nullable()->comment('1可流通，0不可流通');
            $table->tinyInteger('synthetic_status')->nullable()->comment('1可合成，0不可合成');
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
        Schema::dropIfExists('fun_synthetic');
    }
}
