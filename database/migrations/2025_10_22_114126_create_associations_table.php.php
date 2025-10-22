<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('organization_name');
            $table->string('registration_number')->nullable();
            $table->text('mission_statement')->nullable();
            $table->integer('founded_year')->nullable();
            $table->string('website')->nullable();
            $table->integer('number_of_members')->nullable();
            $table->string('organization_type')->nullable();
            $table->timestamps();

            // Ensure one association per user
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('associations');
    }
};
