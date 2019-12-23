<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProjectOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_order', function (Blueprint $table) {
            $table->integer('pr_mer_id')->comment('项目所属用户id');
            $table->integer('partA_status')->default(0)->comment('甲方项目状态');
            $table->integer('partB_status')->default(0)->comment('乙方项目状态');
            $table->string('remark')->nullable()->comment('备注');
            $table->dropColumn(['money', 'is_delay','refund_trade_no','pay_status','channel']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
