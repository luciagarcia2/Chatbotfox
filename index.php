<?php
session_start();

// Si no hay sesión activa, redirige al login
if (!isset($_SESSION['usuario'])) {
    header("Location: ./login.php");
    exit();
}

// Recuperar datos del usuario en sesión
$nombreUsuario = $_SESSION['usuario']['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ChatBot Simple</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="./css/index.css" />
</head>
<body>
  <div class="chat-app">
    <div class="chat-header">
      <div class="chat-avatar"><i class="fas fa-robot"></i></div>
      <div class="chat-title">
        <h1>Asistente Virtual Teclany</h1>
        <p class="status">En línea</p>
      </div>
      <div class="chat-actions">
        <!-- Botón de logout -->
        <a href="./Controller/LoginController.php?action=logout" class="btn-icon" title="Cerrar sesión">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </div>
    </div>
    
    <div id="chat-container">
      <div class="welcome-message visible">
        <p>¡Hola <strong><?php echo htmlspecialchars($nombreUsuario); ?></strong>! 👋<br>
        Soy tu asistente virtual. ¿En qué puedo ayudarte hoy?</p>
      </div>
    </div>
    
    <div class="input-container">
      <input type="text" id="user-input" placeholder="Escribe tu mensaje..." autocomplete="off">
      <button id="send-btn" class="btn-send"><i class="fas fa-paper-plane"></i></button>
      <button class="btn-attach"><i class="fas fa-paperclip"></i></button>
    </div>
  </div>

  <script>
    function escapeHtml(text) {
      return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

    function getCurrentTime() {
      const now = new Date();
      return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function scrollToBottom() {
      const container = $("#chat-container")[0];
      container.scrollTop = container.scrollHeight;
    }

    function displayUserMessage(message) {
      $("#chat-container").append(`
        <div class="message user-message">
          <div class="message-content">${escapeHtml(message)}</div>
          <div class="message-time">${getCurrentTime()}</div>
        </div>
      `);
      scrollToBottom();
    }

    function displayBotMessage(message) {
      $("#chat-container").append(`
        <div class="message bot-message">
          <div class="message-avatar"><i class="fas fa-robot"></i></div>
          <div class="message-content-wrapper">
            <div class="message-content">${escapeHtml(message)}</div>
            <div class="message-time">${getCurrentTime()}</div>
          </div>
        </div>
      `);
      scrollToBottom();
    }

    function displayTypingIndicator() {
      $("#chat-container").append(`
        <div class="message bot-message typing-indicator">
          <div class="message-avatar"><i class="fas fa-robot"></i></div>
          <div class="message-content-wrapper">
            <div class="typing-dots">
              <span></span><span></span><span></span>
            </div>
          </div>
        </div>
      `);
      scrollToBottom();
    }

    function removeTypingIndicator() {
      $(".typing-indicator").remove();
    }

    function callBot(message) {
      displayTypingIndicator();
      $.ajax({
        url: "controlador.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({ pregunta: message }),
        success: function(response) {
          removeTypingIndicator();
          let data;
          try {
            data = (typeof response === "string") ? JSON.parse(response) : response;
          } catch {
            return displayBotMessage("⚠️ Error al procesar la respuesta del servidor.");
          }

          displayBotMessage(data.respuesta || "🤖 No entendí eso. ¿Podés reformular?");
        },
        error: function() {
          removeTypingIndicator();
          displayBotMessage("⚠️ No puedo conectar con el servidor.");
        }
      });
    }

    $("#send-btn").on("click", function(e) {
      e.preventDefault();
      const message = $("#user-input").val().trim();
      if (message) {
        displayUserMessage(message);
        callBot(message);
        $("#user-input").val("");
      }
    });

    $("#user-input").on("keypress", function(e) {
      if (e.which === 13) {
        e.preventDefault();
        $("#send-btn").click();
      }
    });
  </script>
</body>
</html>
