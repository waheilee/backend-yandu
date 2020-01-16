<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkerSeNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker', function (Blueprint $table) {
            $table->string('avatar')->nullable()->comment('工人头像');
            $table->string('channel')->nullable()->comment('工人所需渠道');
            $table->string('password')->nullable()->comment('密码');
            $table->integer('is_active')->nullable()->comment('判断首次登录');
            $table->string('policy_order_num')->nullable()->comment('关联保单订单号');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
