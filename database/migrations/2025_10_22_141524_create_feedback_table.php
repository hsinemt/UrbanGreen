<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('parent_feedback_id')->nullable()->constrained('feedback')->onDelete('cascade');
            $table->text('comment');
            $table->tinyInteger('rating')->nullable()->unsigned()->comment('1-5 stars');
            $table->enum('status', ['active', 'hidden', 'flagged'])->default('active');
            $table->unsignedInteger('likes_count')->default(0);
            $table->boolean('is_edited')->default(false);
            $table->timestamp('edited_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['event_id', 'status']);
            $table->index('parent_feedback_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
