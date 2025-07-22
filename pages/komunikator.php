<?php
session_start();
$loggedIn = isset($_SESSION['username']);
$username = $loggedIn ? htmlspecialchars($_SESSION['username']) : '';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Toryemocji - Komunikator</title>
  <link rel="stylesheet" href="../styles/styles.css?v=123" />
</head>
<body>
  <div class="sidebar">
    <h2>Toryemocji</h2>
    <ul>
      <li><a href="../index.php">🏠 Strona główna</a></li>
      <li>📋 Ankiety</li>
      <li><a href="komunikator.php">💬 Komunikator</a></li>
    </ul>
  </div>

  <div class="main-content">
    <header>
      <input type="text" placeholder="Szukaj w Toryemocji..." class="search" />
      <div class="auth-links">
        <?php if ($loggedIn): ?>
          <span>👋 Witaj, <?= $username ?>!</span>
          <a href="../logout.php">🚪 Wyloguj się</a>
        <?php else: ?>
          <a href="login.html">🔐 Logowanie</a>
          <a href="register.html">🆕 Rejestracja</a>
        <?php endif; ?>
      </div>
    </header>

    <section class="chat-container">
      <h2>💬 Komunikator</h2>
      <div id="chat-box"></div>

      <?php if ($loggedIn): ?>
      <form id="chat-form" autocomplete="off">
        <input type="text" id="message" placeholder="Napisz wiadomość..." required autocomplete="off" />
        <button type="submit">Wyślij</button>
      </form>
      <?php else: ?>
        <p>Musisz być <a href="login.html">zalogowany</a>, aby korzystać z komunikatora.</p>
      <?php endif; ?>
    </section>

  </div>

  <script>
  function loadMessages() {
    fetch('../backend/get_message.php')
      .then(res => res.json())
      .then(data => {
        const box = document.getElementById('chat-box');
        box.innerHTML = '';
        data.reverse().forEach(msg => {
          const line = document.createElement('div');
          line.textContent = `[${msg.created_at}] ${msg.username}: ${msg.message}`;
          box.appendChild(line);
        });
      });
  }

  document.getElementById('chat-form')?.addEventListener('submit', e => {
    e.preventDefault();
    const messageInput = document.getElementById('message');
    const message = messageInput.value.trim();
    if (!message) return;

    const formData = new FormData();
    formData.append('message', message);

    fetch('../backend/send_message.php', {
      method: 'POST',
      body: formData
    }).then(() => {
      messageInput.value = '';
      loadMessages();
    });
  });

  setInterval(loadMessages, 2000);
  loadMessages();
  </script>
</body>
</html>
