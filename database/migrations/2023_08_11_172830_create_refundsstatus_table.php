<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refundsstatus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refund_id');
            $table->string('refund_status');
            $table->timestamps();

            $table->foreign('refund_id')->references('id')->on('refunds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refundsstatus');
    }
};
