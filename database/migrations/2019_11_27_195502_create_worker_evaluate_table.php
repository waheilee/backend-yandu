<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerEvaluateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_evaluate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->comment('所属项目ID');
            $table->integer('evaluate_id_a')->comment('评价人');
            $table->integer('evaluate_id_b')->comment('被评价人');
            $table->integer('start')->nullable()->comment('评价星星数量');
            $table->string('tag')->nullable()->comment('评价标签');
            $table->text('content')->nullable()->comment('评价内容');
            $table->integer('point')->nullable()->comment('好评百分比');
            $table->string('openid')->nullable()->comment('微信openid');
            $table->string('wechat_avatar')->nullable()->comment('微信头像');
            $table->string('wechat_nickname')->nullable()->comment('微信名称');
            $table->string('evaluate_channel',10)->nullable()->comment('评价渠道');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_evaluate');
    }
}
