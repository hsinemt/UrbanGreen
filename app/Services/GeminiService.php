<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private $apiKey;
    private $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    /**
     * Générer une réponse IA avec Gemini
     */
    public function generateResponse(string $userMessage, array $context = []): array
    {
        try {
            // Construire le prompt avec le contexte
            $systemPrompt = $this->buildSystemPrompt($context);
            
            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $systemPrompt . "\n\nUtilisateur: " . $userMessage
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ],
                'safetySettings' => [
                    [
                        'category' => 'HARM_CATEGORY_HARASSMENT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_HATE_SPEECH',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                    ]
                ]
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '?key=' . $this->apiKey, $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $generatedText = $data['candidates'][0]['content']['parts'][0]['text'];
                    
                    return [
                        'success' => true,
                        'response' => $generatedText,
                        'type' => 'ai_response',
                        'context' => $context
                    ];
                }
            }

            Log::error('Gemini API Error: ' . $response->body());
            return $this->getFallbackResponse($userMessage);

        } catch (\Exception $e) {
            Log::error('Gemini Service Error: ' . $e->getMessage());
            return $this->getFallbackResponse($userMessage);
        }
    }

    /**
     * Construire le prompt système avec le contexte
     */
    private function buildSystemPrompt(array $context): string
    {
        $prompt = "Tu es un assistant IA spécialisé dans les plantes, le jardinage et les espaces verts pour la plateforme UrbanGreen. ";
        $prompt .= "Tu es expert en botanique, horticulture, et conseils jardinage. ";
        $prompt .= "Tu peux répondre à toutes sortes de questions sur les plantes, leur entretien, les espaces verts, et le jardinage. ";
        $prompt .= "Sois toujours utile, précis et encourageant. ";
        $prompt .= "Utilise des emojis appropriés pour rendre tes réponses plus engageantes. ";
        $prompt .= "Si tu ne connais pas quelque chose, dis-le honnêtement mais propose des alternatives ou des ressources. ";
        $prompt .= "Reste toujours dans le domaine des plantes et du jardinage, mais sois ouvert à toutes les questions dans ce domaine. ";

        // Ajouter le contexte de la conversation si disponible
        if (!empty($context)) {
            $prompt .= "\n\nContexte de la conversation précédente: ";
            foreach ($context as $key => $value) {
                if (is_array($value)) {
                    $prompt .= "\n- {$key}: " . implode(', ', $value);
                } else {
                    $prompt .= "\n- {$key}: {$value}";
                }
            }
        }

        return $prompt;
    }

    /**
     * Réponse de secours simple en cas d'erreur
     */
    private function getFallbackResponse(string $userMessage): array
    {
        $fallbackResponses = [
            "Je suis désolé, je rencontre un problème technique. 🌱 Mais je peux toujours vous aider avec vos questions sur les plantes ! Pouvez-vous reformuler votre question ?",
            "Oups, il y a un petit problème de connexion. 🌿 N'hésitez pas à me poser vos questions sur le jardinage, je suis là pour vous aider !",
            "Désolé pour ce dysfonctionnement temporaire. 🌳 Parlez-moi de vos plantes, je serai ravi de vous conseiller !"
        ];

        return [
            'success' => false,
            'response' => $fallbackResponses[array_rand($fallbackResponses)],
            'type' => 'fallback',
            'context' => []
        ];
    }

    /**
     * Vérifier si l'API est configurée
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Obtenir des informations sur l'API
     */
    public function getApiInfo(): array
    {
        return [
            'configured' => $this->isConfigured(),
            'api_key_set' => !empty($this->apiKey),
            'base_url' => $this->baseUrl
        ];
    }
}
