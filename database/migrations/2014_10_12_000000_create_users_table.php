<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->uniqnue()->default('')->comment('用户名');
            $table->string('password')->default('')->comment('密码');
            $table->string('email')->nullable()->default('')->comment('邮箱');
            $table->dateTime('email_verified_at')->nullable()->comment('邮箱验证时间');
            $table->string('phone')->nullable()->default('')->comment('手机号');
            $table->dateTime('phone_verified_at')->nullable()->comment('手机号验证时间');
            $table->string('avatar')->nullable()->default('')->comment('头像地址');
            $table->string('realname')->nullable()->default('')->comment('真实姓名');

            $table->rememberToken()->default('')->comment('登录token');
            $table->dateTime('last_active_at')->nullable()->comment('最后活跃时间');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
