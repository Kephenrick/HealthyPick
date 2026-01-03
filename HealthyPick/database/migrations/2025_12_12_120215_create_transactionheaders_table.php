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
            $table->string('Vendor_ID', 255);
            $table->integer('total_price');
            $table->enum('status', ['pending', 'paid', 'completed', 'cancelled']);
            $table->timestamps();

            $table->foreign('Customer_ID')
                ->references('User_ID')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('Vendor_ID')
                ->references('Vendor_ID')
                ->on('vendors')
                ->onDelete('cascade');
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
