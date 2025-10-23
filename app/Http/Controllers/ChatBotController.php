<?php

namespace App\Http\Controllers;

use App\Models\ChatBot;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ChatBotController extends Controller
{
    private $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    /**
     * Afficher l'interface du chatbot pour l'admin
     */
    public function index(): View
    {
        return view('dashboard.components.chatbot.index');
    }

    /**
     * Afficher l'interface du chatbot pour le front office
     */
    public function frontIndex(): View
    {
        return view('frontOffice.pages.chatbot');
    }

    /**
     * Obtenir l'historique des conversations
     */
    public function getHistory(Request $request): JsonResponse
    {
        $sessionId = $request->get('session_id', session()->getId());
        $history = ChatBot::getSessionHistory($sessionId);
        
        return response()->json([
            'success' => true,
            'history' => $history
        ]);
    }

    /**
     * Traiter un message utilisateur et générer une réponse IA
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'nullable|string'
        ]);

        $userMessage = $request->input('message');
        $sessionId = $request->input('session_id', session()->getId());
        
        // Vérifier si Gemini est configuré
        if (!$this->geminiService->isConfigured()) {
            return response()->json([
                'success' => false,
                'response' => 'Le service IA n\'est pas configuré. Veuillez contacter l\'administrateur.',
                'type' => 'error',
                'context' => [],
                'session_id' => $sessionId
            ]);
        }
        
        // Obtenir le contexte de la conversation
        $context = $this->getConversationContext($sessionId);
        
        // Générer la réponse avec Gemini
        $botResponse = $this->geminiService->generateResponse($userMessage, $context);
        
        // Sauvegarder la conversation
        ChatBot::saveConversation($sessionId, $userMessage, $botResponse['response'], $botResponse['context'], $botResponse['type']);
        
        return response()->json([
            'success' => $botResponse['success'],
            'response' => $botResponse['response'],
            'type' => $botResponse['type'],
            'context' => $botResponse['context'],
            'session_id' => $sessionId
        ]);
    }

    /**
     * Obtenir le contexte de la conversation
     */
    private function getConversationContext(string $sessionId): array
    {
        $recentMessages = ChatBot::where('session_id', $sessionId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $context = [];
        foreach ($recentMessages as $msg) {
            if ($msg->context) {
                $context = array_merge($context, $msg->context);
            }
        }
        
        return $context;
    }

    /**
     * Obtenir les informations sur l'API Gemini
     */
    public function getApiInfo(): JsonResponse
    {
        return response()->json($this->geminiService->getApiInfo());
    }
}