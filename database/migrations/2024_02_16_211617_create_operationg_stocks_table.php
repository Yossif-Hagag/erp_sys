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
        Schema::create('operationg_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('operation_type');
            $table->string('operation_document');
            $table->string('client_name');
            $table->string('address');
             $table->decimal('cost', 10, 2);
            // Add other columns as needed

            // Timestamps for created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operationg_stocks');
    }
};
