<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Treningsstudio</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <nav>
      <div class="navbar">
        <div class="nav-left">
          <div class="nav-box"><a href="index.php" class="nav-link">home</a></div>
        </div>
        <div class="nav-center">
          <div class="nav-box"><a href="#" class="nav-link">Lokasjoner</a></div>
          <div class="nav-box"><a href="#" class="nav-link">About Us</a></div>
        </div>
        <div class="nav-right">
          <div class="nav-box"><a href="log-inn.php" class="nav-link">Logg Inn</a></div>
          <div class="nav-box"><a href="Bli-Medlem.php" class="nav-link">Bli Medlem</a></div>
        </div>
      </div>
    </nav>
  </header>

  <main class="image-grid">
      <?php

      // Starter en sesjon
      session_start();
      // Angi databasedetaljene her
      $servername = "172.20.128.28";
      $username = "remote";
      $password = "Skole123";
      $dbname = "medlemer";
    // Sjekker om brukeren er logget inn (om e-posten er satt i sesjonen)
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        // Viser velkomstmeldingen med brukerens e-post
        echo "Velkommen, $email!";
    } else {
        // Viser brukeren ikke er loget inn
        echo "hallo";
    }
    ?>
  <div class="image-container">
    <img src="bilder/alina-chernysheva-JA2S6sJWleg-unsplash.jpg" alt="Bilde 1" style="max-width: 30%; height: auto;">
    <p>Tekst for bilde 1</p>
  </div>
  <div class="image-container">
    <img src="bilder/danielle-cerullo-CQfNt66ttZM-unsplash.jpg" alt="Bilde 1" style="max-width: 30%; height: auto;">
    <p>Tekst for bilde 2</p>
  </div>
  <div class="image-container">
    <img src="bilder/sushil-ghimire-5UbIqV58CW8-unsplash.jpg" alt="Bilde 1" style="max-width: 30%; height: auto;">
    <p>Tekst for bilde 3</p>
  </div>
</main>

  <footer>
  </footer>
</body>
</html>



