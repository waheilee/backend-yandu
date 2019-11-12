<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num')->comment('项目编号，自动生成')->unique();
            $table->bigInteger('merchant_id')->comment('订单所属用户ID');
            $table->string('project_name')->comment('项目名称');
            $table->string('address')->comment('项目地点');
            $table->string('begin_time')->comment('项目开始时间');
            $table->string('end_time')->comment('项目结束时间');
            $table->string('size')->comment('项目平米数大小');
            $table->string('project_time')->comment('预估项目工期');
            $table->string('budget')->comment('项目成本预算价格');
            $table->string('cash_deposit')->comment('乙方所欲缴纳的保证金');
            $table->integer('people_num')->comment('乙方参与此项目所需达到的最低施工人数');
            $table->string('phone',15)->comment('联系方式');
            $table->text('content')->comment('项目详情介绍');
            $table->integer('status')->nullable()->default('0')->comment('项目状态,0、未承接，1、已承接，2、竣工');
            $table->string('interest')->nullable()->comment('对此项目有意向的商户');
            $table->bigInteger('partner_merchant_id')->nullable()->comment('最终合作商户ID（乙方）');
            $table->time('check_project_time')->nullable()->comment('项目验收时间');
            $table->softDeletes();

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
        Schema::dropIfExists('project_order');
    }
}
