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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('pro_name');
            $table->Integer('pro_num');
            $table->string('pro_photo')->nullable();
            $table->Integer('rent_price');
            $table->Integer('rent_period');
            $table->string('Tenant_name');
            $table->bigInteger('Tenant_phone');
            $table->string('Tenant_address');
            $table->integer('number_of_product');
            $table->Integer('supplier_id');
            $table->Integer('pro_id')->nullable();
            $table->Integer('purchas_id')->nullable();
            $table->Integer('pro_sup_price')->nullable();
            $table->Integer('purchas_sup_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
