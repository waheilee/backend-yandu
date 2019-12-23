<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMemberPoliciesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_policies', function (Blueprint $table) {
            $table->dateTime('out_time')->nullable()->comment('保单过期时间');
            $table->string('order_no')->comment('关联订单号');
            $table->string('policy_type')->nullable()->comment('保单类型');
            $table->string('age')->nullable()->comment('年龄')->change();
            $table->string('payroll')->nullable()->comment('薪资范围')->change();
            $table->string('email')->nullable()->comment('邮箱')->change();

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
