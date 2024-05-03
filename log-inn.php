<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-Inn</title>
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
            margin-top: 16%;
            margin-bottom: 16% ;
        }
        #tekst {
            background-color: #0056b3;
            color: white;
            padding: 3px;
            border-radius: 10px;
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
        <h1>Logg inn:</h1>
        <form method="post">
            <label>epost: <input type="email" name="epost"></label> <br>
            <label>Passord: <input type="password" name="password"></label> <br>
            <input type="submit" name="login" value="Logg inn">
        </form>

        <h1>Er ikke medlem?</h1>
        <div id="tekst"><a href="Bli-Medlem.php" class="nav-link">Registrer deg her</a></div>
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

// brukeren loger seg inn
if (isset($_POST['login'])) {
    $epost = $conn->real_escape_string($_POST['epost']);
    $passord = $conn->real_escape_string($_POST['password']);

    //sjeker om at eposten fines
    $sql = "SELECT * FROM brukere WHERE epost = '$epost'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        //sjeker om både epost og passord matcher det i databasen
        if (password_verify($passord, $user['passord'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_epost'] = $user['epost'];
            header("Location: treningstudio-nettside/index.php");
            exit;
        } else {
            echo "Feil brukernavn eller passord.";
        }
    } else {
        echo "Feil brukernavn eller passord.";
    }
}

?>
</body>
</html>