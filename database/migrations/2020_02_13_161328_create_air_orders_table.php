<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Constants\BaseConstants;

class CreateAirOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');

            $table->string('no')->comment('订单流水号');

            $table->unsignedInteger('user_id')->comment('订单所属商家');
            $table->decimal('total', 12, 2)->comment('总计价格');
            $table->tinyInteger('status')->default(0)->comment('');
            $table->string('pay_type')->nullable()->comment('支付类型');
            $table->string('area',10)->nullable()->comment('施工面积');


            $table->tinyInteger('type')->default(0)->comment('订单类型,1普通订单，2秒杀订单');

            $table->string('name')->nullable()->comment('订单的名字，用于第三方，只有一个商品就是商品的名字，多个商品取联合');
            // 收货地址
            $table->string('consignee_name')->nullable()->comment('收货人');
            $table->string('consignee_phone')->nullable()->comment('收货人手机号码');
            $table->string('consignee_address')->nullable()->comment('收货地址');

            // 第三方支付
            $table->string('pay_no')->nullable()->comment('第三方支付单号');
            $table->decimal('pay_total', 12, 2)->nullable()->comment('实际支付金额');
            $table->timestamp('pay_time')->nullable()->comment('支付时间');
            $table->decimal('pay_refund_fee', 12, 2)->nullable()->comment('退款金额');
            $table->string('pay_trade_no')->nullable()->comment('第三方退款订单号');

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
        Schema::dropIfExists('orders');
    }
}
