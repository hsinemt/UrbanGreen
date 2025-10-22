<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('organization_name');
            $table->string('partnership_type')->nullable();
            $table->string('industry_sector')->nullable();
            $table->date('partnership_start_date')->nullable();
            $table->string('contribution_type')->nullable();
            $table->string('contact_person')->nullable();
            $table->timestamps();

            // Ensure one partner per user
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
