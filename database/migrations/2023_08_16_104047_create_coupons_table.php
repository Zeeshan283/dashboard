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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->decimal('discount_value',10,2);
            $table->date('start_date');
            $table->data('expiration_date');
            $table->integer('mpa')->nullable(); // minimum purchase amount
            $table->integer('redemption_count')->default(0);
            $table->unsignedBigInteger('vendor');
            $table->enum('status', ['Active', 'Inactive', 'Expired']);  
            $table->timestamps();
            
            // forigen key relation 
            $table->foreign('vendor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
