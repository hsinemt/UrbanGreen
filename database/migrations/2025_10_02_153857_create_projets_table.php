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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('status');
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('priority')->default(3); // 1=high,5=low
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->json('tags')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('progress_percentage');
            $table->decimal('budget', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
