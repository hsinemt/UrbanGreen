<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date_of_birth')->nullable();
            $table->text('skills')->nullable();
            $table->string('availability')->nullable();
            $table->integer('hours_contributed')->default(0);
            $table->date('joined_date')->nullable();
            $table->string('volunteer_id_number')->nullable();
            $table->timestamps();

            // Ensure one volunteer per user
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
