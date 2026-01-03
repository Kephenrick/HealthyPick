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
        Schema::create('transactionitems', function (Blueprint $table) {
            $table->string('Transaction_Item_ID', 255)->primary();
            $table->string('Transaction_ID', 255);
            $table->string('Product_ID', 255);
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('subtotal');
            $table->timestamps();

            $table->foreign('Transaction_ID')
                ->references('Transaction_ID')
                ->on('transactionheaders')
                ->onDelete('cascade');

            $table->foreign('Product_ID')
                ->references('Product_ID')
                ->on('products')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionitems');
    }
};
