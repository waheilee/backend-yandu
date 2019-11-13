<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('merchant_id');
            $table->integer('project_id');
            $table->integer('deposit_type')->comment('押金类型，1交押金，2退押金');
            $table->decimal('deposit')->comment('押金金额，押金余额');
            $table->string('relate_order_id')->nullable()->comment('关联订单ID');
            $table->string('relate_order')->nullable()->comment('关联订单');
            $table->string('remark')->nullable()->comment('操作备注');
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
        Schema::dropIfExists('project_deposits');
    }
}
