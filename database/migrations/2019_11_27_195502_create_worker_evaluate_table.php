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
            $table->integer('start')->comment('评价星星数量');
            $table->string('tag',30)->comment('评价标签');
            $table->text('content')->comment('评价内容');
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
