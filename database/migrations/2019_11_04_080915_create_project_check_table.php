<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_check', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->comment('所属项目ID');
            $table->integer('merchant_id')->comment('验收提交方ID');
            $table->text('content')->comment('验收报告');
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
        Schema::dropIfExists('check_project');
    }
}
