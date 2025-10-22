<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('frontOffice/img/favicon.png') }}">
    <title>@yield('title', 'Ecozone')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('frontOffice/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/light-gallerr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/loginstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/donations.css') }}">

    <link rel="stylesheet" href="{{ asset('frontOffice/css/auth-styles.css') }}">

    @stack('styles')
</head>
<body>
<!-- Preloader (optional keep as-is) -->
<div class="cs_preloader">
    <div class="cs_preloader_in">
        <span></span>
        <span></span>
    </div>
    <div class="cs_preloader_shape"><img src="{{ asset('frontOffice/img/nature/about_shape_1.svg') }}" alt=""></div>
    <div class="cs_preloader_shape_2"><img src="{{ asset('frontOffice/img/nature/about_shape_2.svg') }}" alt=""></div>
</div>

@include('frontOffice.partials.header')

<main>
    @yield('content')
</main>

@include('frontOffice.partials.footer')

<!-- Scripts -->
<script src="{{ asset('frontOffice/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/jquery.slick.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/odometer.js') }}"></script>
<script src="{{ asset('frontOffice/js/YTPlayer.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/light-gallery.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/ripples.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/gsap.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/wow.min.js') }}"></script>
<!-- Add Bootstrap 5 bundle (includes Popper) for dropdowns/modals/tooltips -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontOffice/js/main.js') }}"></script>

<!-- Assistant IA Widget Flottant -->
<div class="cs_ai_widget" id="aiWidget">
    <div class="cs_ai_widget_button" id="aiWidgetButton">
        <i class="fas fa-robot"></i>
        <span class="cs_ai_widget_text">Assistant IA</span>
    </div>
    <div class="cs_ai_widget_popup" id="aiWidgetPopup">
        <div class="cs_ai_widget_header">
            <div class="d-flex align-items-center">
                <div class="cs_ai_widget_avatar me-2">
                    <i class="fas fa-robot"></i>
                </div>
                <div>
                    <h6 class="mb-0">Assistant IA Plantes</h6>
                    <small class="text-muted">En ligne</small>
                </div>
            </div>
            <button type="button" class="btn-close" id="closeWidget"></button>
        </div>
        <div class="cs_ai_widget_content">
            <div class="cs_ai_widget_messages" id="widgetMessages">
                <div class="cs_widget_message cs_widget_message_bot">
                    <div class="cs_widget_message_bubble">
                        <p class="mb-0">Bonjour ! Je suis votre assistant IA spécialisé dans les plantes. Comment puis-je vous aider ?</p>
                    </div>
                </div>
            </div>
            <div class="cs_ai_widget_input">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" id="widgetMessageInput" placeholder="Posez votre question...">
                    <button class="btn btn-primary btn-sm" type="button" id="widgetSendButton">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
            <div class="cs_ai_widget_footer">
                <a href="{{ route('chatbot.front.index') }}" class="btn btn-outline-primary btn-sm w-100">
                    <i class="fas fa-external-link-alt me-1"></i>
                    Ouvrir l'assistant complet
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.cs_ai_widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.cs_ai_widget_button {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(40,167,69,0.3);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
}

.cs_ai_widget_button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(40,167,69,0.4);
}

.cs_ai_widget_button i {
    font-size: 20px;
}

.cs_ai_widget_popup {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 350px;
    height: 400px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.cs_ai_widget_popup.show {
    display: flex;
}

.cs_ai_widget_header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cs_ai_widget_avatar {
    width: 35px;
    height: 35px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cs_ai_widget_content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.cs_ai_widget_messages {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    background: #f8f9fa;
}

.cs_widget_message {
    margin-bottom: 10px;
}

.cs_widget_message_bot .cs_widget_message_bubble {
    background: white;
    padding: 10px 15px;
    border-radius: 15px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    max-width: 80%;
}

.cs_widget_message_user .cs_widget_message_bubble {
    background: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 15px;
    margin-left: auto;
    max-width: 80%;
}

.cs_ai_widget_input {
    padding: 15px;
    border-top: 1px solid #e9ecef;
}

.cs_ai_widget_footer {
    padding: 10px 15px;
    border-top: 1px solid #e9ecef;
    background: #f8f9fa;
}

/* Responsive */
@media (max-width: 768px) {
    .cs_ai_widget_popup {
        width: 300px;
        height: 350px;
    }
    
    .cs_ai_widget_button {
        padding: 12px 16px;
    }
    
    .cs_ai_widget_text {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const widgetButton = document.getElementById('aiWidgetButton');
    const widgetPopup = document.getElementById('aiWidgetPopup');
    const closeWidget = document.getElementById('closeWidget');
    const widgetMessages = document.getElementById('widgetMessages');
    const widgetMessageInput = document.getElementById('widgetMessageInput');
    const widgetSendButton = document.getElementById('widgetSendButton');
    
    let sessionId = 'widget_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    
    // Ouvrir/fermer le widget
    widgetButton.addEventListener('click', () => {
        widgetPopup.classList.toggle('show');
        if (widgetPopup.classList.contains('show')) {
            widgetMessageInput.focus();
        }
    });
    
    closeWidget.addEventListener('click', () => {
        widgetPopup.classList.remove('show');
    });
    
    // Envoyer un message depuis le widget
    function sendWidgetMessage(message) {
        if (!message.trim()) return;
        
        // Afficher le message utilisateur
        addWidgetMessage(message, 'user');
        
        // Vider l'input
        widgetMessageInput.value = '';
        
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
            if (data.success) {
                addWidgetMessage(data.response, 'bot');
            } else {
                addWidgetMessage('Désolé, une erreur est survenue.', 'bot');
            }
        })
        .catch(error => {
            addWidgetMessage('Désolé, une erreur est survenue.', 'bot');
            console.error('Error:', error);
        });
    }
    
    // Ajouter un message au widget
    function addWidgetMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `cs_widget_message cs_widget_message_${sender}`;
        
        messageDiv.innerHTML = `
            <div class="cs_widget_message_bubble">
                <p class="mb-0">${text}</p>
            </div>
        `;
        
        widgetMessages.appendChild(messageDiv);
        widgetMessages.scrollTop = widgetMessages.scrollHeight;
    }
    
    // Event listeners
    widgetSendButton.addEventListener('click', () => {
        const message = widgetMessageInput.value.trim();
        if (message) {
            sendWidgetMessage(message);
        }
    });
    
    widgetMessageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const message = widgetMessageInput.value.trim();
            if (message) {
                sendWidgetMessage(message);
            }
        }
    });
});
</script>

@stack('scripts')
</body>
</html>
