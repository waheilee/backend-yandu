<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_merchant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('project_id')->comment('所属项目id');
            $table->bigInteger('merchant_id')->comment('商户id');
            $table->string('worker_id')->comment('工人id');
            $table->integer('status')->default(0)->comment('状态:0未合作，1合作');
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
        Schema::dropIfExists('project_merchant');
    }
}
