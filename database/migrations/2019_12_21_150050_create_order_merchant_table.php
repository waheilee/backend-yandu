<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_merchant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_num')->unique()->comment('订单流水号');
            $table->string('pay_order_num')->nullable()->comment('支付平台返回的单号');
            $table->string('refund_trade_no')->nullable()->comment('退款单号');
            $table->integer('user_id')->comment('下单用户id');
            $table->string('address')->nullable()->comment('地址');
            $table->integer('type')->nullable()->comment('商品类型（例如：项目保证金、购买保单）');
            $table->decimal('total_amount', 10, 2)->comment('订单总金额');
            $table->dateTime('pay_time')->nullable()->comment('支付时间');
            $table->dateTime('refund_time')->nullable()->comment('退款时间');
            $table->integer('pay_status')->default(0)->comment('支付状态，0未支付，1已支付，2已退款，3已过期');
            $table->integer('refund_status')->default(0)->comment('是否已退款');
            $table->integer('order_status')->default(0)->comment('订单状态');
            $table->integer('channel')->comment('渠道,渠道分两种微信支付宝');
            $table->text('remark')->nullable()->comment('订单备注');
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
        Schema::dropIfExists('order_merchant');
    }
}
