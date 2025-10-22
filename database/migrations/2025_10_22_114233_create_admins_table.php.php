<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('admin_level')->default('standard'); // standard, super, etc.
            $table->json('permissions')->nullable();
            $table->timestamps();

            // Ensure one admin per user
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
