<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactionheaders', function (Blueprint $table) {
            $table->string('Transaction_ID', 255)->primary();
            $table->string('Customer_ID', 255);
            $table->string('Product_ID', 255);
            $table->string('Status', 255);
            $table->integer('Quantity');
            $table->timestamps();

            $table->foreign('Customer_ID')->references('Customer_ID')->on('customers')->onDelete('cascade');
            $table->foreign('Product_ID')->references('Product_ID')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionheaders');
    }
};
