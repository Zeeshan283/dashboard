<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->text('message');
            $table->INT('Order_id');
            $table->VARCHAR('coupon_type');
            $table->VARCHAR('coupon_used');
            $table->VARCHAR('status');

            // Add any additional fields you need for notifications
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
