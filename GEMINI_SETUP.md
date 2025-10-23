# Configuration de l'API Gemini pour UrbanGreen

## Vue d'ensemble

Le chatbot UrbanGreen a été mis à jour pour utiliser l'API Gemini de Google, offrant une expérience IA plus intelligente et ouverte à toutes sortes de questions sur les plantes et le jardinage.

## Configuration requise

### 1. Obtenir une clé API Gemini

1. Rendez-vous sur [Google AI Studio](https://aistudio.google.com/)
2. Connectez-vous avec votre compte Google
3. Créez un nouveau projet ou utilisez un projet existant
4. Générez une clé API pour Gemini Pro
5. Copiez la clé API générée

### 2. Configuration de l'environnement

Ajoutez la clé API à votre fichier `.env` :

```env
# Configuration Gemini API
GEMINI_API_KEY=votre_cle_api_gemini_ici
```

### 3. Vérification de la configuration

Vous pouvez vérifier que l'API est correctement configurée en accédant à :
- Front office : `/assistant-ia`
- Back office : `/admin/chatbot`

## Fonctionnalités

### Avantages de l'intégration Gemini

- **Réponses intelligentes** : L'IA peut répondre à des questions complexes et variées
- **Contexte conversationnel** : Mémorise les échanges précédents pour des réponses cohérentes
- **Ouverture** : Peut traiter toutes sortes de questions liées aux plantes et au jardinage
- **Personnalisation** : Réponses adaptées au domaine des espaces verts et de l'horticulture
- **Modèle Gemini 2.0 Flash Expérimental** : Utilise la dernière version expérimentale de Gemini pour des réponses ultra-rapides et intelligentes

### Types de questions supportées

- Recommandations de plantes
- Conseils d'entretien et de soins
- Questions sur les espaces verts
- Problèmes de jardinage
- Questions générales sur la botanique
- Et bien plus encore !

## Architecture technique

### Services

- **GeminiService** : Service principal pour l'intégration avec l'API Gemini
- **ChatBotController** : Contrôleur mis à jour pour utiliser Gemini
- **ChatBot Model** : Modèle inchangé pour la persistance des conversations

### Sécurité

- Validation des entrées utilisateur
- Limitation de la taille des messages (1000 caractères)
- Paramètres de sécurité Gemini configurés
- Gestion des erreurs et réponses de secours

## Dépannage

### Problèmes courants

1. **"Le service IA n'est pas configuré"**
   - Vérifiez que `GEMINI_API_KEY` est définie dans votre `.env`
   - Redémarrez le serveur après modification du `.env`

2. **Erreurs de connexion ou modèles non disponibles**
   - Le chatbot affiche un message d'erreur simple
   - Vérifiez votre connexion internet et la validité de la clé API
   - Le modèle Gemini 2.0 Flash Exp est très récent, assurez-vous qu'il est disponible

3. **Réponses rapides**
   - Gemini 2.0 Flash Exp est optimisé pour la vitesse
   - Réponses généralement en moins d'une seconde
   - Modèle expérimental avec les dernières fonctionnalités

### Logs et monitoring

Les erreurs sont loggées dans `storage/logs/laravel.log` avec le tag "Gemini Service Error".

## Coûts et limites

- L'API Gemini a des limites de taux et de coûts
- Consultez la [documentation officielle Gemini](https://ai.google.dev/docs) pour les détails
- Surveillez votre utilisation via Google AI Studio

## Support

Pour toute question technique :
1. Consultez les logs Laravel
2. Vérifiez la configuration de l'API
3. Testez avec des questions simples d'abord

---

**Note** : Cette intégration remplace l'ancien système de réponses prédéfinies par une IA générative plus flexible et intelligente.
