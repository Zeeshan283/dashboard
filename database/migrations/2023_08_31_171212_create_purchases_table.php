<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('bill_number');
            $table->unsignedBigInteger('supplier');
            $table->unsignedBigInteger('user_id'); // New field for user ID
            $table->unsignedBigInteger('product_id');
            $table->string('selected_product_model');
            $table->integer('quantity');
            $table->decimal('selected_product_price', 10, 2);
            $table->decimal('total_value', 10, 2);
            $table->timestamps();
    
            // Foreign key relationship with products table
            $table->foreign('supplier')->references('id')->on('supplier'); // Assuming 'sku' is the column name in the products table
            $table->foreign('product_id')->references('id')->on('products'); // Assuming 'sku' is the column name in the products table
            $table->foreign('user_id')->references('id')->on('users'); // Assuming your users table has 'id' as primary key
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
