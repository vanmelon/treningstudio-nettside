<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        main {
            text-align: center;
        }

        .register-box {
            width: 300px;
            margin: 0 auto;
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            margin-top: 19%;
            margin-bottom: 19% ;
        }
    </style>
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

<main>
    <div class="register-box">
        <h1>Ikke brukernavn? Registrer deg:</h1>
        <form method="post">
            <label>E-post: <input type="email" name="email"></label> <br>
            <label>Passord: <input type="password" name="password"></label> <br>
            <input type="submit" name="register" value="Registrer">
        </form>
    </div>
</main>

<footer>
</footer>

<?php
session_start();

// Angi databasedetaljene her
$servername = "172.20.128.28";
$username = "remote";
$password = "Skole123";
$dbname = "medlemer";

// Kobler til databasen
$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk tilkoblingen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Registrering av ny bruker
if (isset($_POST['register'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $epost = $conn->real_escape_string($_POST['email']);
        $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

        try {
            // Sjekker om epost finnes
            $sql = "SELECT * FROM brukere WHERE epost = '$epost'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "Eposten er allerede i bruk.";
            } else {
                // Oppretter ny bruker
                $sql = "INSERT INTO brukere (epost, passord) VALUES ('$epost', '$password')";
                if ($conn->query($sql) === TRUE) {
                    // Brukeren ble registrert, omdiriger til en annen side for å unngå form re-submission
                    header("Location: treningstudio-nettside/log-inn.php");
                    exit;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo "Fyll inn alle felter.";
    }
}

// Lukk tilkoblingen
$conn->close();
?>


</body>
</html>