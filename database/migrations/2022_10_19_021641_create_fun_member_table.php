<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fun_member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile')->nullable()->comment('手机号码');
            $table->string('username')->nullable()->comment('昵称');
            $table->string('realname')->nullable()->comment('真名');
            $table->string('first_consume')->default('0.00')->nullable()->comment('首发消费');
            $table->unsignedInteger('chip_num')->default('0')->nullable()->comment('当前碎片数量');
            $table->integer('upper_id')->comment('上级ID');
            $table->string('password')->nullable()->comment('密码');
            $table->integer('birthday')->default('0')->comment('生日');
            $table->unsignedMediumInteger('address_id')->default('0')->comment('默认收货地址');
            $table->unsignedInteger('last_login')->default('0')->comment('最后登录时间');
            $table->integer('login_num')->default('0')->nullable()->comment('登录次数');
            $table->string('last_ip')->default('0')->comment('最后登录ip');
            $table->string('avatar')->nullable()->comment('头像');
            $table->tinyInteger('level_id')->default('1')->nullable()->comment('会员等级');
            $table->tinyInteger('status')->default('1')->nullable()->comment('状态（1启用，0禁用）');
            $table->string('token')->nullable()->comment('登陆token');
            $table->string('promo_code')->nullable()->comment('推广码');
            $table->unsignedInteger('create_time')->default('0')->nullable()->comment('注册时间');
            $table->integer('update_time')->default('0')->nullable()->comment('更新时间');
            $table->integer('delete_time')->default('0')->comment('删除时间');
            $table->string('rate')->default('000000001.00')->comment('分润比例');
            $table->integer('chip_total')->nullable()->comment('拥有碎片累计总数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fun_member');
    }
}
