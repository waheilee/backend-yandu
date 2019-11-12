<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('merchant_id')->comment('付款商户id');
            $table->integer('project_id')->comment('付款项目id');
            $table->string('order_no')->comment('订单号');
            $table->string('money')->comment('订单押金金额');
            $table->integer('is_delay')->nullable()->default(0)->comment('是否超时');
            $table->string('refund_trade_no')->comment('退款单号');
            $table->integer('pay_status')->comment('支付状态，0未支付，1已支付，2已退款，3已过期');
            $table->string('channel')->comment('渠道,渠道分两种 WEB和MINI');
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
