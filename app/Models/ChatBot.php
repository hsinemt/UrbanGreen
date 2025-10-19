<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatBot extends Model
{
    protected $fillable = [
        'session_id',
        'user_message',
        'bot_response',
        'context',
        'message_type',
    ];

    protected $casts = [
        'context' => 'array',
    ];

    /**
     * Obtenir l'historique des conversations pour une session
     */
    public static function getSessionHistory($sessionId, $limit = 20)
    {
        return self::where('session_id', $sessionId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();
    }

    /**
     * Sauvegarder un échange de conversation
     */
    public static function saveConversation($sessionId, $userMessage, $botResponse, $context = null, $messageType = 'text')
    {
        return self::create([
            'session_id' => $sessionId,
            'user_message' => $userMessage,
            'bot_response' => $botResponse,
            'context' => $context,
            'message_type' => $messageType,
        ]);
    }
}
