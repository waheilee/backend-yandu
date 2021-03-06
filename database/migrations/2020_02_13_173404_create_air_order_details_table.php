<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');

            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');

            $table->integer('number')->comment('数量');
            $table->decimal('price', 12, 2)->comment('商品单价');
            $table->decimal('total', 12, 2)->comment('价格小计算');

            $table->boolean('is_commented')->default(false)->comment('订单是否评论过');
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
        Schema::dropIfExists('order_details');
    }
}
