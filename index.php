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
  <title>Toryemocji - Strona główna</title>
  <link rel="stylesheet" href="styles/styles.css" />
</head>
<body>
  <div class="sidebar">
    <h2>Toryemocji</h2>
    <ul>
      <li>🏠 Strona główna</li>
      <li>📋 Ankiety</li>
      <li>💬 Komunikator</li>
    </ul>
  </div>

  <div class="main-content">
    <header>
      <input type="text" placeholder="Szukaj w Toryemocji..." class="search" />
      <div class="auth-links">
        <?php if ($loggedIn): ?>
          <span>👋 Witaj, <?= $username ?>!</span>
          <a href="logout.php">🚪 Wyloguj się</a>
        <?php else: ?>
          <a href="pages/login.html">🔐 Logowanie</a>
          <a href="pages/register.html">🆕 Rejestracja</a>
        <?php endif; ?>
      </div>
    </header>

    <section class="ankiet-grid">
      <div class="card">
        <h3>Ankieta 1</h3>
        <p>Opis ankiety 1</p>
      </div>
      <div class="card">
        <h3>Ankieta 2</h3>
        <p>Opis ankiety 2</p>
      </div>
      <div class="card">
        <h3>Ankieta 3</h3>
        <p>Opis ankiety 3</p>
      </div>
    </section>
  </div>
</body>
</html>
