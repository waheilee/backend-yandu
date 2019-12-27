<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMemberPolicyStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_policies', function (Blueprint $table) {
            $table->integer('status')->nullable()->comment('保单状态0:未付款。1:已付款，但暂未生效。2:已付款，已生效。3:已过期');
            $table->bigInteger('renewal_times')->default(0)->comment('计入续费次数');

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
