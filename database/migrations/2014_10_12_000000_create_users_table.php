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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('phone');
            $table->string('job_type')->default(null);
            $table->Integer('salary')->default(null);
            // ---------------------------
            $table->Integer('holidays')->default(null);
            $table->Integer('holi_rest')->default(null);
            $table->Integer('over_time')->default(null);
            $table->Integer('attendance')->default(null)->nullable();
            // ---------------------------
            $table->string('emp_file')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
