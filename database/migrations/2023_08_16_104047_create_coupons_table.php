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
            $table->string('coupon_type');
            $table->string('coupon_title');
            $table->string('coupon_code');
            $table->decimal('minimum_purchase', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('discount_type')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->integer('limit_same_user')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->timestamps();

            // forigen key relation 
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
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
