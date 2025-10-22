<?php

namespace App\Http\Controllers;

use App\Models\ChatBot;
use App\Models\Plant;
use App\Models\GreenSpace;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ChatBotController extends Controller
{
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
        
        // Générer la réponse IA
        $botResponse = $this->generateAIResponse($userMessage, $sessionId);
        
        // Sauvegarder la conversation
        ChatBot::saveConversation($sessionId, $userMessage, $botResponse['response'], $botResponse['context'], $botResponse['type']);
        
        return response()->json([
            'success' => true,
            'response' => $botResponse['response'],
            'type' => $botResponse['type'],
            'context' => $botResponse['context'],
            'session_id' => $sessionId
        ]);
    }

    /**
     * Générer une réponse IA basée sur le message utilisateur
     */
    private function generateAIResponse(string $message, string $sessionId): array
    {
        $message = strtolower(trim($message));
        
        // Analyser le contexte de la conversation précédente
        $context = $this->getConversationContext($sessionId);
        
        // Détecter le type de demande
        $intent = $this->detectIntent($message);
        
        switch ($intent) {
            case 'plant_recommendation':
                return $this->handlePlantRecommendation($message, $context);
            
            case 'plant_care':
                return $this->handlePlantCare($message, $context);
            
            case 'green_space_info':
                return $this->handleGreenSpaceInfo($message, $context);
            
            case 'greeting':
                return $this->handleGreeting();
            
            case 'help':
                return $this->handleHelp();
            
            default:
                return $this->handleGeneralQuestion($message, $context);
        }
    }

    /**
     * Détecter l'intention de l'utilisateur
     */
    private function detectIntent(string $message): string
    {
        $plantKeywords = ['plante', 'fleur', 'arbre', 'herbe', 'végétal', 'jardin', 'potager'];
        $careKeywords = ['arroser', 'eau', 'soleil', 'ombre', 'engrais', 'taille', 'soin', 'entretien'];
        $spaceKeywords = ['espace vert', 'jardin', 'parc', 'terrain', 'surface'];
        $greetingKeywords = ['bonjour', 'salut', 'hello', 'hi', 'coucou'];
        $helpKeywords = ['aide', 'help', 'commande', 'que puis-je', 'comment'];
        
        if (array_intersect(explode(' ', $message), $greetingKeywords)) {
            return 'greeting';
        }
        
        if (array_intersect(explode(' ', $message), $helpKeywords)) {
            return 'help';
        }
        
        if (array_intersect(explode(' ', $message), $plantKeywords)) {
            return 'plant_recommendation';
        }
        
        if (array_intersect(explode(' ', $message), $careKeywords)) {
            return 'plant_care';
        }
        
        if (array_intersect(explode(' ', $message), $spaceKeywords)) {
            return 'green_space_info';
        }
        
        return 'general';
    }

    /**
     * Gérer les recommandations de plantes
     */
    private function handlePlantRecommendation(string $message, array $context): array
    {
        // Analyser les préférences mentionnées
        $preferences = $this->extractPreferences($message);
        
        // Générer des recommandations externes basées sur les préférences
        $recommendations = $this->generateExternalRecommendations($preferences);
        
        // Optionnellement mentionner les plantes existantes si pertinentes
        $existingPlants = $this->getRelevantExistingPlants($preferences);
        
        $response = "Voici mes recommandations personnalisées pour vous :\n\n";
        $response .= $recommendations;
        
        if ($existingPlants->isNotEmpty()) {
            $response .= "\n\n🌿 **Plantes disponibles dans nos espaces verts :**\n";
            foreach ($existingPlants->take(3) as $plant) {
                $response .= "• **{$plant->nom}** - {$plant->milieu_croissance} (Espace: {$plant->greenSpace->name})\n";
            }
            $response .= "\n💡 *Ces plantes sont déjà présentes dans nos espaces verts et peuvent vous servir de référence !*";
        }
        
        $response .= "\n\n💡 **Besoin d'aide ?** Posez-moi des questions sur l'entretien, l'arrosage ou le placement de ces plantes !";
        
        return [
            'response' => $response,
            'type' => 'plant_recommendation',
            'context' => array_merge($context, ['preferences' => $preferences, 'external_recommendations' => true])
        ];
    }

    /**
     * Gérer les questions sur l'entretien des plantes
     */
    private function handlePlantCare(string $message, array $context): array
    {
        $response = "🌿 **Conseils d'entretien des plantes :**\n\n";
        
        if (strpos($message, 'arroser') !== false || strpos($message, 'eau') !== false) {
            $response .= "💧 **Arrosage :**\n";
            $response .= "• Vérifiez l'humidité du sol avec votre doigt\n";
            $response .= "• Arrosez quand le sol est sec sur 2-3 cm\n";
            $response .= "• Évitez l'eau stagnante dans les soucoupes\n";
            $response .= "• Préférez l'arrosage le matin\n\n";
        }
        
        if (strpos($message, 'soleil') !== false || strpos($message, 'lumière') !== false) {
            $response .= "☀️ **Luminosité :**\n";
            $response .= "• Plantes d'intérieur : lumière indirecte brillante\n";
            $response .= "• Évitez le soleil direct sur les feuilles\n";
            $response .= "• Tournez vos plantes régulièrement\n";
            $response .= "• Surveillez les signes de brûlure\n\n";
        }
        
        if (strpos($message, 'engrais') !== false || strpos($message, 'nutriments') !== false) {
            $response .= "🌱 **Fertilisation :**\n";
            $response .= "• Fertilisez pendant la période de croissance (printemps-été)\n";
            $response .= "• Utilisez un engrais équilibré dilué\n";
            $response .= "• Respectez les doses recommandées\n";
            $response .= "• Arrêtez en hiver pour la plupart des plantes\n\n";
        }
        
        $response .= "💡 **Conseil général :** Chaque plante est unique ! Observez-la régulièrement et adaptez vos soins selon ses réactions.";
        
        return [
            'response' => $response,
            'type' => 'plant_care',
            'context' => array_merge($context, ['care_topic' => $this->extractCareTopic($message)])
        ];
    }

    /**
     * Gérer les informations sur les espaces verts
     */
    private function handleGreenSpaceInfo(string $message, array $context): array
    {
        $greenSpaces = GreenSpace::withCount('plants')->get();
        
        $response = "🌳 **Nos Espaces Verts :**\n\n";
        
        foreach ($greenSpaces as $space) {
            $response .= "📍 **{$space->name}**\n";
            $response .= "• Localisation : {$space->location}\n";
            $response .= "• Surface : {$space->surface} m²\n";
            $response .= "• Type : " . ($space->type ?: 'Non spécifié') . "\n";
            $response .= "• Plantes : {$space->plants_count} plantes\n";
            $response .= "• Statut : " . ($space->availability ? 'Disponible' : 'Occupé') . "\n\n";
        }
        
        $response .= "💡 **Intéressé par un espace ?** Dites-moi quel type de plantes vous souhaitez planter et je vous conseillerai !";
        
        return [
            'response' => $response,
            'type' => 'green_space_info',
            'context' => array_merge($context, ['spaces_count' => $greenSpaces->count()])
        ];
    }

    /**
     * Gérer les salutations
     */
    private function handleGreeting(): array
    {
        $greetings = [
            "Bonjour ! 🌱 Je suis votre assistant IA spécialisé dans les plantes et les espaces verts. Comment puis-je vous aider aujourd'hui ?",
            "Salut ! 🌿 Je suis là pour vous conseiller sur le choix et l'entretien de vos plantes. Que souhaitez-vous savoir ?",
            "Hello ! 🌳 Bienvenue dans notre univers végétal. Posez-moi vos questions sur les plantes et les jardins !"
        ];
        
        return [
            'response' => $greetings[array_rand($greetings)],
            'type' => 'greeting',
            'context' => []
        ];
    }

    /**
     * Gérer les demandes d'aide
     */
    private function handleHelp(): array
    {
        $response = "🤖 **Comment puis-je vous aider ?**\n\n";
        $response .= "🌱 **Recommandations de plantes :**\n";
        $response .= "• \"Quelle plante pour mon salon ?\"\n";
        $response .= "• \"Je veux une plante facile à entretenir\"\n";
        $response .= "• \"Plante pour débutant\"\n\n";
        $response .= "🌿 **Conseils d'entretien :**\n";
        $response .= "• \"Comment arroser ma plante ?\"\n";
        $response .= "• \"Ma plante a besoin de plus de soleil ?\"\n";
        $response .= "• \"Quand fertiliser ?\"\n\n";
        $response .= "🌳 **Espaces verts :**\n";
        $response .= "• \"Montrez-moi vos espaces verts\"\n";
        $response .= "• \"Quel espace pour planter ?\"\n\n";
        $response .= "💡 **Astuce :** Plus vous me donnez de détails, plus mes conseils seront précis !";
        
        return [
            'response' => $response,
            'type' => 'help',
            'context' => []
        ];
    }

    /**
     * Gérer les questions générales
     */
    private function handleGeneralQuestion(string $message, array $context): array
    {
        $response = "Je comprends votre question, mais je suis spécialisé dans les conseils sur les plantes et les espaces verts. 🌱\n\n";
        $response .= "Voici ce que je peux vous aider :\n";
        $response .= "• Recommander des plantes adaptées à vos besoins\n";
        $response .= "• Conseiller sur l'entretien et les soins\n";
        $response .= "• Informer sur nos espaces verts\n";
        $response .= "• Répondre à vos questions jardinage\n\n";
        $response .= "💡 **Astuce :** Essayez de reformuler votre question en mentionnant \"plante\", \"jardin\" ou \"espace vert\" !";
        
        return [
            'response' => $response,
            'type' => 'general',
            'context' => $context
        ];
    }

    /**
     * Extraire les préférences du message utilisateur
     */
    private function extractPreferences(string $message): array
    {
        $preferences = [];
        
        // Milieu
        if (strpos($message, 'intérieur') !== false || strpos($message, 'dedans') !== false || 
            strpos($message, 'maison') !== false || strpos($message, 'appartement') !== false ||
            strpos($message, 'salon') !== false || strpos($message, 'chambre') !== false ||
            strpos($message, 'bureau') !== false) {
            $preferences['milieu'] = 'Intérieur';
        } elseif (strpos($message, 'extérieur') !== false || strpos($message, 'dehors') !== false || 
                  strpos($message, 'jardin') !== false || strpos($message, 'balcon') !== false ||
                  strpos($message, 'terrasse') !== false || strpos($message, 'cour') !== false) {
            $preferences['milieu'] = 'Extérieur';
        }
        
        // Difficulté
        if (strpos($message, 'facile') !== false || strpos($message, 'débutant') !== false || 
            strpos($message, 'simple') !== false || strpos($message, 'commencer') !== false ||
            strpos($message, 'première') !== false || strpos($message, 'novice') !== false) {
            $preferences['difficulty'] = 'easy';
        } elseif (strpos($message, 'difficile') !== false || strpos($message, 'expert') !== false ||
                  strpos($message, 'avancé') !== false || strpos($message, 'challenge') !== false) {
            $preferences['difficulty'] = 'hard';
        }
        
        // Taille
        if (strpos($message, 'petit') !== false || strpos($message, 'mini') !== false || 
            strpos($message, 'compact') !== false || strpos($message, 'petite') !== false) {
            $preferences['size'] = 'small';
        } elseif (strpos($message, 'grand') !== false || strpos($message, 'gros') !== false ||
                  strpos($message, 'grande') !== false || strpos($message, 'imposant') !== false) {
            $preferences['size'] = 'large';
        }
        
        // Lumière
        if (strpos($message, 'soleil') !== false || strpos($message, 'lumière') !== false ||
            strpos($message, 'éclairé') !== false || strpos($message, 'lumineux') !== false) {
            $preferences['light'] = 'bright';
        } elseif (strpos($message, 'ombre') !== false || strpos($message, 'sombre') !== false ||
                  strpos($message, 'peu de lumière') !== false) {
            $preferences['light'] = 'low';
        }
        
        // Arrosage
        if (strpos($message, 'peu d\'eau') !== false || strpos($message, 'rarement') !== false ||
            strpos($message, 'oubli') !== false || strpos($message, 'résistant') !== false) {
            $preferences['watering'] = 'low';
        } elseif (strpos($message, 'beaucoup d\'eau') !== false || strpos($message, 'souvent') !== false ||
                  strpos($message, 'humide') !== false) {
            $preferences['watering'] = 'high';
        }
        
        // Usage spécifique
        if (strpos($message, 'purifier') !== false || strpos($message, 'air') !== false) {
            $preferences['purpose'] = 'air_purifying';
        } elseif (strpos($message, 'culinaire') !== false || strpos($message, 'cuisine') !== false ||
                  strpos($message, 'manger') !== false) {
            $preferences['purpose'] = 'culinary';
        } elseif (strpos($message, 'fleur') !== false || strpos($message, 'fleurir') !== false ||
                  strpos($message, 'couleur') !== false) {
            $preferences['purpose'] = 'flowering';
        }
        
        return $preferences;
    }

    /**
     * Générer des recommandations externes basées sur les préférences
     */
    private function generateExternalRecommendations(array $preferences): string
    {
        $milieu = $preferences['milieu'] ?? null;
        $difficulty = $preferences['difficulty'] ?? null;
        $size = $preferences['size'] ?? null;
        $light = $preferences['light'] ?? null;
        $watering = $preferences['watering'] ?? null;
        $purpose = $preferences['purpose'] ?? null;
        
        $response = "";
        
        // Recommandations selon le milieu
        if ($milieu === 'Intérieur') {
            $response .= "🏠 **Plantes d'intérieur recommandées :**\n\n";
            
            if ($difficulty === 'easy') {
                $response .= "🌱 **Pour débutants :**\n";
                $response .= "• **Pothos (Epipremnum aureum)** - Très facile, purifie l'air\n";
                $response .= "• **Sansevieria (Langue de belle-mère)** - Résistante, peu d'arrosage\n";
                $response .= "• **Chlorophytum (Plante araignée)** - Croissance rapide, facile à multiplier\n";
                $response .= "• **Zamioculcas (ZZ Plant)** - Très robuste, idéale pour les oublieux\n\n";
            } else {
                $response .= "🌿 **Plantes d'intérieur populaires :**\n";
                $response .= "• **Monstera deliciosa** - Feuilles spectaculaires, tendance\n";
                $response .= "• **Ficus lyrata** - Élégant, purifie l'air\n";
                $response .= "• **Calathea** - Feuilles colorées, mouvement quotidien\n";
                $response .= "• **Philodendron** - Variétés nombreuses, croissance vigoureuse\n\n";
            }
            
            if ($size === 'small') {
                $response .= "🌱 **Petites plantes parfaites :**\n";
                $response .= "• **Succulentes** - Echeveria, Haworthia\n";
                $response .= "• **Pilea peperomioides** - Feuilles rondes, très mignonnes\n";
                $response .= "• **Fittonia** - Feuilles nervurées colorées\n\n";
            }
            
            // Recommandations selon la lumière
            if ($light === 'low') {
                $response .= "🌑 **Pour espaces peu éclairés :**\n";
                $response .= "• **Sansevieria** - Tolère très bien l'ombre\n";
                $response .= "• **Pothos** - S'adapte à la faible luminosité\n";
                $response .= "• **Zamioculcas** - Très résistant à l'ombre\n\n";
            } elseif ($light === 'bright') {
                $response .= "☀️ **Pour espaces très éclairés :**\n";
                $response .= "• **Ficus lyrata** - Aime la lumière indirecte\n";
                $response .= "• **Monstera** - Se développe bien avec beaucoup de lumière\n";
                $response .= "• **Succulentes** - Nécessitent beaucoup de lumière\n\n";
            }
            
            // Recommandations selon l'arrosage
            if ($watering === 'low') {
                $response .= "💧 **Plantes nécessitant peu d'eau :**\n";
                $response .= "• **Sansevieria** - Arrosage très espacé\n";
                $response .= "• **Zamioculcas** - Résistante à la sécheresse\n";
                $response .= "• **Succulentes** - Stockent l'eau dans leurs feuilles\n\n";
            }
            
            // Recommandations selon l'usage
            if ($purpose === 'air_purifying') {
                $response .= "🌬️ **Plantes purificatrices d'air :**\n";
                $response .= "• **Chlorophytum** - Excellente purificatrice\n";
                $response .= "• **Pothos** - Absorbe les toxines\n";
                $response .= "• **Ficus lyrata** - Purifie efficacement l'air\n\n";
            }
            
        } elseif ($milieu === 'Extérieur') {
            $response .= "🌳 **Plantes d'extérieur recommandées :**\n\n";
            
            if ($difficulty === 'easy') {
                $response .= "🌱 **Pour débutants :**\n";
                $response .= "• **Lavande** - Parfumée, résistante à la sécheresse\n";
                $response .= "• **Romarin** - Culinaire, très résistant\n";
                $response .= "• **Géranium** - Floraison généreuse, facile\n";
                $response .= "• **Thym** - Aromatique, couvre-sol\n\n";
            } else {
                $response .= "🌿 **Plantes d'extérieur populaires :**\n";
                $response .= "• **Hortensia** - Fleurs spectaculaires\n";
                $response .= "• **Rosier** - Variétés nombreuses, floraison longue\n";
                $response .= "• **Bambou** - Croissance rapide, écran naturel\n";
                $response .= "• **Olivier** - Méditerranéen, très décoratif\n\n";
            }
            
            if ($size === 'small') {
                $response .= "🌱 **Petites plantes d'extérieur :**\n";
                $response .= "• **Herbes aromatiques** - Basilic, persil, ciboulette\n";
                $response .= "• **Pensées** - Floraison colorée\n";
                $response .= "• **Pâquerettes** - Résistantes, charmantes\n\n";
            }
            
            // Recommandations selon l'usage
            if ($purpose === 'culinary') {
                $response .= "🍽️ **Plantes culinaires :**\n";
                $response .= "• **Basilic** - Aromatique, facile à cultiver\n";
                $response .= "• **Persil** - Polyvalent en cuisine\n";
                $response .= "• **Romarin** - Résistant, très aromatique\n";
                $response .= "• **Thym** - Parfait pour les grillades\n\n";
            } elseif ($purpose === 'flowering') {
                $response .= "🌸 **Plantes à fleurs :**\n";
                $response .= "• **Géranium** - Floraison longue et colorée\n";
                $response .= "• **Pensées** - Fleurs multicolores\n";
                $response .= "• **Lavande** - Fleurs parfumées\n";
                $response .= "• **Rosier** - Fleurs élégantes\n\n";
            }
            
        } else {
            // Recommandations générales
            $response .= "🌱 **Mes recommandations générales :**\n\n";
            
            $response .= "🏠 **Plantes d'intérieur faciles :**\n";
            $response .= "• **Pothos** - Parfait pour débuter\n";
            $response .= "• **Sansevieria** - Très résistante\n";
            $response .= "• **Monstera** - Très tendance\n\n";
            
            $response .= "🌳 **Plantes d'extérieur faciles :**\n";
            $response .= "• **Lavande** - Parfumée et résistante\n";
            $response .= "• **Romarin** - Culinaire et décoratif\n";
            $response .= "• **Géranium** - Floraison généreuse\n\n";
        }
        
        // Conseils généraux
        $response .= "💡 **Conseils pour bien choisir :**\n";
        $response .= "• Considérez la luminosité de votre espace\n";
        $response .= "• Évaluez le temps que vous pouvez consacrer à l'entretien\n";
        $response .= "• Pensez à la taille adulte de la plante\n";
        $response .= "• Vérifiez la toxicité si vous avez des animaux\n";
        
        return $response;
    }
    
    /**
     * Obtenir les plantes existantes pertinentes
     */
    private function getRelevantExistingPlants(array $preferences)
    {
        $query = Plant::with('greenSpace');
        
        if (isset($preferences['milieu'])) {
            $query->where('milieu_croissance', $preferences['milieu']);
        }
        
        return $query->limit(3)->get();
    }

    /**
     * Extraire le sujet de soin du message
     */
    private function extractCareTopic(string $message): string
    {
        if (strpos($message, 'arroser') !== false || strpos($message, 'eau') !== false) {
            return 'watering';
        } elseif (strpos($message, 'soleil') !== false || strpos($message, 'lumière') !== false) {
            return 'light';
        } elseif (strpos($message, 'engrais') !== false || strpos($message, 'nutriments') !== false) {
            return 'fertilizer';
        }
        
        return 'general';
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
}