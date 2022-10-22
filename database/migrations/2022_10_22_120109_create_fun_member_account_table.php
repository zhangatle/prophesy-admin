<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunMemberAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_member_account', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('merchant_id')->default('0')->nullable()->comment('商户id');
            $table->unsignedInteger('member_id')->default('0')->nullable()->comment('用户id');
            $table->decimal('money_before')->default('0.00')->nullable()->comment('变更之前金额');
            $table->decimal('money_now')->default('0.00')->nullable()->comment('当前余额');
            $table->decimal('money_change')->nullable()->comment('变更金额');
            $table->decimal('money_all')->default('0.00')->nullable()->comment('累计余额');
            $table->decimal('money_consume')->default('0.00')->nullable()->comment('累计消费金额');
            $table->decimal('money_frozen')->default('0.00')->nullable()->comment('冻结金额');
            $table->tinyInteger('status')->default('1')->nullable()->comment('状态=[-1:删除;0:禁用;1启用]');
            $table->integer('type')->default('1')->nullable()->comment('类型');
            $table->unsignedInteger('create_time')->default('0')->comment('创建时间');
            $table->integer('update_time')->default('0')->nullable()->comment('跟新时间');
            $table->integer('delete_time')->default('0')->nullable()->comment('删除时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_member_account');
    }
}
