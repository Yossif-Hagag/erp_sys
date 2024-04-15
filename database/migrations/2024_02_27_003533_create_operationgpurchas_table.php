<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operationgpurchas', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('operation_type');
            $table->string('operation_document');
            $table->string('client_name');
            $table->string('address');
            $table->decimal('start_price', 10, 2);
            $table->decimal('cost', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operationgpurchas');
    }
};
