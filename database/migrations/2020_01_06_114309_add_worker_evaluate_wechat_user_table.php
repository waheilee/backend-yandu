<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkerEvaluateWechatUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker_evaluate', function (Blueprint $table) {
            $table->integer('point')->nullable()->comment('好评百分比');
            $table->string('openid')->nullable()->comment('微信openid');
            $table->string('wechat_avatar')->nullable()->comment('微信头像');
            $table->string('wechat_nickname')->nullable()->comment('微信名称');
            $table->string('evaluate_channel',10)->nullable()->comment('评价渠道');
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
