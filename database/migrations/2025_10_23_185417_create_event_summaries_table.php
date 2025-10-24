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
        Schema::create('event_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->text('summary_text');
            $table->decimal('sentiment_positive_percent', 5, 2)->default(0);
            $table->decimal('sentiment_neutral_percent', 5, 2)->default(0);
            $table->decimal('sentiment_negative_percent', 5, 2)->default(0);
            $table->integer('total_comments_analyzed')->default(0);
            $table->timestamp('generated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_summaries');
    }
};
