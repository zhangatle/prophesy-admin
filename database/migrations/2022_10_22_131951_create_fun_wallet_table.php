<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_wallet', function (Blueprint $table) {
            $table->increments('member_id');
            $table->string('total')->default('0.00')->comment('余额');
            $table->integer('chip_total')->default('0')->comment('拥有碎片累计总数');
            $table->unsignedInteger('chip_num')->default('0')->comment('当前碎片数量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_wallet');
    }
}
