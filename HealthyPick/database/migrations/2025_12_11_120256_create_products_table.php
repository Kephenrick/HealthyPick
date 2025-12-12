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
        Schema::create('products', function (Blueprint $table) {
            $table->string('Product_ID', 255)->primary();
            $table->string('Name', 255);
            $table->string('Description', 500);
            $table->integer('Price');
            $table->string('Vendor_ID', 255);
            $table->integer('Stock');
            $table->timestamps();
            $table->foreign('Vendor_ID')->references('Vendor_ID')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
