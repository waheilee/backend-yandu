<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMemberPolicyNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_policies', function (Blueprint $table) {
            $table->integer('number')->nullable()->comment('投保份数（每份保单为期一个月）');
            $table->string('channel')->nullable()->comment('保单所属渠道');
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
