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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('pro_name');
            $table->integer('pro_num');
            $table->integer('supply_price');
            $table->integer('sell_price');
            $table->integer('number_of_product');
            $table->string('seller');
            $table->integer('seller_phone');
            $table->string('seller_address');
            $table->string('source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
