@extends('frontOffice.layouts.app')
@section('title', 'Assistant IA - Conseils Plantes')

@section('content')
<!-- Start Hero Section -->
<section class="cs_hero cs_style_1 cs_heading_bg cs_center cs_bg_filed" data-src="{{ asset('frontOffice/img/nature/hero_bg.jpg') }}">
    <div class="container">
        <div class="cs_hero_text text-center">
            <h1 class="cs_hero_title cs_fs_70 cs_white_color cs_mb_30">Assistant IA pour vos Plantes</h1>
            <p class="cs_hero_subtitle cs_white_color cs_mb_37">Obtenez des conseils personnalisés sur le choix et l'entretien de vos plantes grâce à notre intelligence artificielle spécialisée.</p>
        </div>
    </div>
</section>
<!-- End Hero Section -->

<!-- Start Chatbot Section -->
<section class="cs_chatbot_section cs_padding_100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="cs_chatbot_container">
                    <!-- Header -->
                    <div class="cs_chatbot_header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="cs_chatbot_avatar me-3">
                                    <img src="{{ asset('frontOffice/img/icons/plant-ai-icon.svg') }}" alt="Assistant IA" class="img-fluid">
                                </div>
                                <div>
                                    <h4 class="cs_chatbot_title mb-0">Assistant IA Plantes</h4>
                                    <p class="cs_chatbot_subtitle mb-0">En ligne • Prêt à vous aider</p>
                                </div>
                            </div>
                            <div class="cs_chatbot_controls">
                                <button type="button" class="btn btn-outline-secondary btn-sm me-2" id="clearChat">
                                    <i class="fas fa-trash me-1"></i> Effacer
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm" id="showHelp">
                                    <i class="fas fa-question-circle me-1"></i> Aide
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div class="cs_chatbot_messages" id="chatMessages">
                        <!-- Welcome Message -->
                        <div class="cs_message cs_message_bot mb-3">
                            <div class="d-flex align-items-start">
                                <div class="cs_message_avatar me-3">
                                    <div class="cs_avatar_bot">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                </div>
                                <div class="cs_message_content">
                                    <div class="cs_message_bubble">
                                        <div class="cs_message_text">
                                            <h6 class="mb-2 text-primary">🌱 Bienvenue dans votre Assistant IA !</h6>
                                            <p class="mb-2">Je suis votre expert en plantes et espaces verts. Je peux vous aider avec :</p>
                                            <ul class="list-unstyled mb-0">
                                                <li>🌿 <strong>Recommandations de plantes</strong> adaptées à vos besoins</li>
                                                <li>💧 <strong>Conseils d'entretien</strong> et de soins</li>
                                                <li>🌳 <strong>Informations sur les espaces verts</strong></li>
                                                <li>❓ <strong>Réponses à vos questions</strong> jardinage</li>
                                            </ul>
                                            <p class="mt-2 mb-0"><em>Comment puis-je vous aider aujourd'hui ?</em></p>
                                        </div>
                                        <div class="cs_message_time">
                                            {{ now()->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Suggestions -->
                    <div class="cs_quick_suggestions">
                        <div class="cs_suggestions_title">
                            <h6>Suggestions rapides :</h6>
                        </div>
                        <div class="cs_suggestions_buttons">
                            <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn" data-suggestion="Quelle plante pour débutant ?">
                                🌱 Plante débutant
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn" data-suggestion="Comment arroser ma plante ?">
                                💧 Arrosage
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn" data-suggestion="Plante pour mon salon">
                                🏠 Plante intérieur
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn" data-suggestion="Plante culinaire pour mon jardin">
                                🍽️ Plante culinaire
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn" data-suggestion="Plante qui purifie l'air">
                                🌬️ Purification air
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn" data-suggestion="Montrez-moi vos espaces verts">
                                🌳 Espaces verts
                            </button>
                        </div>
                    </div>

                    <!-- Input Area -->
                    <div class="cs_chatbot_input">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control form-control-lg" 
                                   id="messageInput" 
                                   placeholder="Posez votre question sur les plantes..."
                                   autocomplete="off">
                            <button class="btn btn-primary btn-lg" type="button" id="sendButton">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Chatbot Section -->

<!-- Start Features Section -->
<section class="cs_features_section cs_padding_100 cs_bg_filed" data-src="{{ asset('frontOffice/img/nature/features_bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="cs_feature_item text-center">
                    <div class="cs_feature_icon mb-3">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h5 class="cs_heading_color">Recommandations Personnalisées</h5>
                    <p class="cs_heading_color">Obtenez des suggestions de plantes adaptées à votre environnement et vos préférences.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="cs_feature_item text-center">
                    <div class="cs_feature_icon mb-3">
                        <i class="fas fa-tint"></i>
                    </div>
                    <h5 class="cs_heading_color">Conseils d'Entretien</h5>
                    <p class="cs_heading_color">Apprenez les meilleures pratiques pour arroser, fertiliser et soigner vos plantes.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="cs_feature_item text-center">
                    <div class="cs_feature_icon mb-3">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h5 class=" cs_heading_color">Expertise Botanique</h5>
                    <p class="cs_heading_color">Bénéficiez de l'expertise de notre IA spécialisée dans le domaine végétal.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Features Section -->

<!-- Custom Styles -->
<style>
.cs_chatbot_section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 80vh;
}

.cs_chatbot_container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    height: 600px;
    display: flex;
    flex-direction: column;
}

.cs_chatbot_header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
}

.cs_chatbot_avatar img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,0.3);
}

.cs_chatbot_title {
    font-weight: 600;
    margin: 0;
}

.cs_chatbot_subtitle {
    font-size: 0.9rem;
    opacity: 0.9;
}

.cs_chatbot_messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.cs_message {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cs_message_bubble {
    background: white;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    max-width: 80%;
    word-wrap: break-word;
}

.cs_message_user .cs_message_bubble {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    margin-left: auto;
}

.cs_message_bot .cs_message_bubble {
    background: white;
    border: 1px solid #e9ecef;
}

.cs_message_avatar {
    flex-shrink: 0;
}

.cs_avatar_bot {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
}

.cs_message_time {
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 8px;
}

.cs_quick_suggestions {
    padding: 15px 20px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.cs_suggestions_title h6 {
    margin-bottom: 10px;
    color: #495057;
    font-weight: 600;
}

.cs_suggestions_buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.suggestion-btn {
    transition: all 0.2s ease;
    border-radius: 20px;
    padding: 8px 16px;
}

.suggestion-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,123,255,0.3);
}

.cs_chatbot_input {
    padding: 20px;
    background: white;
    border-top: 1px solid #e9ecef;
}

.cs_chatbot_input .form-control {
    border-radius: 25px;
    border: 2px solid #e9ecef;
    padding: 12px 20px;
}

.cs_chatbot_input .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(40,167,69,0.25);
    border-color: #28a745;
}

.cs_chatbot_input .btn {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    margin-left: 10px;
}

.cs_features_section {
    background-attachment: fixed;
    color: white;
}

.cs_feature_item {
    padding: 30px 20px;
    background: rgba(255,255,255,0.1);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    transition: transform 0.3s ease;
}

.cs_feature_item:hover {
    transform: translateY(-5px);
}

.cs_feature_icon i {
    font-size: 3rem;
    color: #28a745;
}

.cs_feature_title {
    color: white;
    font-weight: 600;
    margin-bottom: 15px;
}

.cs_feature_text {
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
}

/* Scrollbar personnalisée */
.cs_chatbot_messages::-webkit-scrollbar {
    width: 6px;
}

.cs_chatbot_messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.cs_chatbot_messages::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.cs_chatbot_messages::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Typing indicator */
.typing-indicator {
    display: none;
}

.typing-indicator.show {
    display: block;
}

.typing-dots {
    display: inline-block;
}

.typing-dots span {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #6c757d;
    margin: 0 2px;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(1) { animation-delay: -0.32s; }
.typing-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes typing {
    0%, 80%, 100% {
        transform: scale(0);
        opacity: 0.5;
    }
    40% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .cs_chatbot_container {
        height: 500px;
        margin: 0 15px;
    }
    
    .cs_suggestions_buttons {
        flex-direction: column;
    }
    
    .suggestion-btn {
        width: 100%;
        margin-bottom: 5px;
    }
}
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const clearButton = document.getElementById('clearChat');
    const helpButton = document.getElementById('showHelp');
    const suggestionButtons = document.querySelectorAll('.suggestion-btn');
    
    let sessionId = generateSessionId();
    
    // Générer un ID de session unique
    function generateSessionId() {
        return 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }
    
    // Envoyer un message
    function sendMessage(message) {
        if (!message.trim()) return;
        
        // Afficher le message utilisateur
        addMessage(message, 'user');
        
        // Vider l'input
        messageInput.value = '';
        
        // Afficher l'indicateur de frappe
        showTypingIndicator();
        
        // Envoyer la requête
        fetch('{{ route("chatbot.front.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                message: message,
                session_id: sessionId
            })
        })
        .then(response => response.json())
        .then(data => {
            hideTypingIndicator();
            if (data.success) {
                addMessage(data.response, 'bot', data.type);
            } else {
                addMessage('Désolé, une erreur est survenue. Veuillez réessayer.', 'bot', 'error');
            }
        })
        .catch(error => {
            hideTypingIndicator();
            addMessage('Désolé, une erreur est survenue. Veuillez réessayer.', 'bot', 'error');
            console.error('Error:', error);
        });
    }
    
    // Ajouter un message à la conversation
    function addMessage(text, sender, type = 'text') {
        const messageDiv = document.createElement('div');
        messageDiv.className = `cs_message cs_message_${sender} mb-3`;
        
        const currentTime = new Date().toLocaleTimeString('fr-FR', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        let icon = 'fas fa-robot';
        if (sender === 'user') {
            icon = 'fas fa-user';
        } else if (type === 'plant_recommendation') {
            icon = 'fas fa-seedling';
        } else if (type === 'plant_care') {
            icon = 'fas fa-tint';
        } else if (type === 'green_space_info') {
            icon = 'fas fa-leaf';
        }
        
        messageDiv.innerHTML = `
            <div class="d-flex align-items-start">
                <div class="cs_message_avatar me-3">
                    <div class="cs_avatar_bot">
                        <i class="${icon}"></i>
                    </div>
                </div>
                <div class="cs_message_content">
                    <div class="cs_message_bubble">
                        <div class="cs_message_text">${formatMessage(text)}</div>
                        <div class="cs_message_time">${currentTime}</div>
                    </div>
                </div>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }
    
    // Formater le message (markdown simple)
    function formatMessage(text) {
        return text
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/\n/g, '<br>')
            .replace(/•/g, '&bull;');
    }
    
    // Afficher l'indicateur de frappe
    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'cs_message cs_message_bot mb-3 typing-indicator show';
        typingDiv.innerHTML = `
            <div class="d-flex align-items-start">
                <div class="cs_message_avatar me-3">
                    <div class="cs_avatar_bot">
                        <i class="fas fa-robot"></i>
                    </div>
                </div>
                <div class="cs_message_content">
                    <div class="cs_message_bubble">
                        <div class="typing-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        chatMessages.appendChild(typingDiv);
        scrollToBottom();
    }
    
    // Masquer l'indicateur de frappe
    function hideTypingIndicator() {
        const typingIndicator = document.querySelector('.typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }
    
    // Faire défiler vers le bas
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Effacer la conversation
    function clearChat() {
        const messages = chatMessages.querySelectorAll('.cs_message');
        messages.forEach(message => {
            if (!message.querySelector('.typing-indicator')) {
                message.remove();
            }
        });
        sessionId = generateSessionId();
    }
    
    // Afficher l'aide
    function showHelp() {
        const helpMessage = `🤖 **Comment utiliser l'Assistant IA :**

🌱 **Recommandations de plantes :**
• "Quelle plante pour mon salon ?"
• "Je veux une plante facile à entretenir"
• "Plante pour débutant"

🌿 **Conseils d'entretien :**
• "Comment arroser ma plante ?"
• "Ma plante a besoin de plus de soleil ?"
• "Quand fertiliser ?"

🌳 **Espaces verts :**
• "Montrez-moi vos espaces verts"
• "Quel espace pour planter ?"

💡 **Astuce :** Plus vous me donnez de détails, plus mes conseils seront précis !`;
        
        addMessage(helpMessage, 'bot', 'help');
    }
    
    // Event listeners
    sendButton.addEventListener('click', () => {
        const message = messageInput.value.trim();
        if (message) {
            sendMessage(message);
        }
    });
    
    messageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const message = messageInput.value.trim();
            if (message) {
                sendMessage(message);
            }
        }
    });
    
    clearButton.addEventListener('click', clearChat);
    helpButton.addEventListener('click', showHelp);
    
    // Suggestions rapides
    suggestionButtons.forEach(button => {
        button.addEventListener('click', () => {
            const suggestion = button.getAttribute('data-suggestion');
            sendMessage(suggestion);
        });
    });
    
    // Focus sur l'input au chargement
    messageInput.focus();
});
</script>
@endsection
