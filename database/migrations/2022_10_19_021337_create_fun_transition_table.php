<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunTransitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_transition', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('out_member_id')->nullable()->comment('转出用户id');
            $table->string('out_name')->nullable()->comment('转出用户名称');
            $table->string('out_mobile')->nullable()->comment('转出用户手机');
            $table->integer('in_member_id')->nullable()->comment('转入用户id');
            $table->string('in_name')->nullable()->comment('转入用户名称');
            $table->string('in_mobile')->nullable()->comment('转入用户手机');
            $table->integer('product_id')->nullable()->comment('商品id');
            $table->string('product_name')->nullable()->comment('商品名称');
            $table->integer('product_no')->nullable()->comment('商品编号');
            $table->dateTime('create_time')->nullable()->comment('转出时间');
            $table->integer('channel')->nullable()->comment('1内部，2外部');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_transition');
    }
}
