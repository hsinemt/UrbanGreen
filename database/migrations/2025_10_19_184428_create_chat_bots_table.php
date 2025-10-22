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
        Schema::create('chat_bots', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index(); // Pour identifier les sessions de chat
            $table->text('user_message'); // Message de l'utilisateur
            $table->text('bot_response'); // Réponse du bot
            $table->json('context')->nullable(); // Contexte supplémentaire (préférences, etc.)
            $table->string('message_type')->default('text'); // Type de message (text, plant_recommendation, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_bots');
    }
};
