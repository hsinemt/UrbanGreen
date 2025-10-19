@extends('dashboard.layouts.dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Assistant IA - Conseils Plantes</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('back.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Assistant IA</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <iconify-icon icon="solar:chat-round-outline" class="me-2"></iconify-icon>
                                    Assistant IA pour les Plantes
                                </h5>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="clearChat">
                                        <iconify-icon icon="solar:trash-bin-minimalistic-outline" class="me-1"></iconify-icon>
                                        Effacer
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm" id="showHelp">
                                        <iconify-icon icon="solar:question-circle-outline" class="me-1"></iconify-icon>
                                        Aide
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Zone de chat -->
                            <div class="chat-container" style="height: 600px; display: flex; flex-direction: column;">
                                <!-- Messages -->
                                <div class="chat-messages flex-grow-1 p-3" id="chatMessages" style="overflow-y: auto; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                    <!-- Message de bienvenue -->
                                    <div class="message bot-message mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar me-3">
                                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="solar:chat-round-outline"></iconify-icon>
                                                </div>
                                            </div>
                                            <div class="message-content">
                                                <div class="message-bubble bg-white rounded-3 p-3 shadow-sm">
                                                    <div class="message-text">
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
                                                    <div class="message-time text-muted small mt-2">
                                                        {{ now()->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Zone de saisie -->
                                <div class="chat-input p-3 border-top bg-white">
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control form-control-lg" 
                                               id="messageInput" 
                                               placeholder="Posez votre question sur les plantes..."
                                               autocomplete="off">
                                        <button class="btn btn-primary btn-lg" type="button" id="sendButton">
                                            <iconify-icon icon="solar:plain-2-outline"></iconify-icon>
                                        </button>
                                    </div>
                                    
                                    <!-- Suggestions rapides -->
                                    <div class="suggestions mt-2">
                                        <div class="d-flex flex-wrap gap-2">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles CSS personnalisés -->
<style>
.chat-container {
    border-radius: 0.5rem;
    overflow: hidden;
}

.message {
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

.message-bubble {
    max-width: 80%;
    word-wrap: break-word;
}

.user-message .message-bubble {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
    color: white;
    margin-left: auto;
}

.bot-message .message-bubble {
    background: white;
    border: 1px solid #e9ecef;
}

.message-time {
    font-size: 0.75rem;
}

.suggestion-btn {
    transition: all 0.2s ease;
}

.suggestion-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,123,255,0.2);
}

#messageInput:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    border-color: #007bff;
}

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

.message-text h6 {
    font-weight: 600;
}

.message-text ul li {
    margin-bottom: 0.25rem;
}

/* Scrollbar personnalisée */
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<!-- JavaScript pour les interactions -->
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
        fetch('{{ route("admin.chatbot.send") }}', {
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
        messageDiv.className = `message ${sender}-message mb-3`;
        
        const currentTime = new Date().toLocaleTimeString('fr-FR', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        let icon = 'solar:chat-round-outline';
        if (sender === 'user') {
            icon = 'solar:user-outline';
        } else if (type === 'plant_recommendation') {
            icon = 'solar:plant-outline';
        } else if (type === 'plant_care') {
            icon = 'solar:waterdrop-outline';
        } else if (type === 'green_space_info') {
            icon = 'solar:leaf-outline';
        }
        
        messageDiv.innerHTML = `
            <div class="d-flex align-items-start">
                <div class="avatar me-3">
                    <div class="avatar-sm bg-${sender === 'user' ? 'success' : 'primary'} text-white rounded-circle d-flex align-items-center justify-content-center">
                        <iconify-icon icon="${icon}"></iconify-icon>
                    </div>
                </div>
                <div class="message-content">
                    <div class="message-bubble bg-${sender === 'user' ? 'primary' : 'white'} text-${sender === 'user' ? 'white' : 'dark'} rounded-3 p-3 shadow-sm">
                        <div class="message-text">${formatMessage(text)}</div>
                        <div class="message-time text-muted small mt-2">${currentTime}</div>
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
        typingDiv.className = 'message bot-message mb-3 typing-indicator show';
        typingDiv.innerHTML = `
            <div class="d-flex align-items-start">
                <div class="avatar me-3">
                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                        <iconify-icon icon="solar:chat-round-outline"></iconify-icon>
                    </div>
                </div>
                <div class="message-content">
                    <div class="message-bubble bg-white rounded-3 p-3 shadow-sm">
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
        const messages = chatMessages.querySelectorAll('.message');
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
