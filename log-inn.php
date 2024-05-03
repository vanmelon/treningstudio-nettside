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
        <div id="tekst"><a href="Bli-medlem.php" class="nav-link">Registrer deg her</a></div>
    </div>
</main>

<footer>
</footer>

<?php
session_start();

// Angi databasedetaljene her
$servername = "172.20.128.28";
$username ="root"
$password ="Skole123"
$dbname = "medlemer";

try {
    //kobler til serveren og databasen
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// brukeren loger seg inn
if (isset($_POST['login'])) {
    $epost = filter_input(INPUT_POST, 'epost', FILTER_SANITIZE_EMAIL);
    $passord = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    //sjeker om at eposten fines
    $sth = $pdo->prepare('SELECT * FROM brukere WHERE epost = ?');
    $sth->execute([$epost]);
    $user = $sth->fetch(PDO::FETCH_ASSOC);
    //sjeker om både epost og passord matsjer det i databasen
    if ($user && password_verify($passord, $user['passord'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_epost'] = $user['epost'];
        header("Location: index.php");
        exit;
        //hvis brukeren skrev noe feil
    } else {
        echo "Feil brukernavn eller passord.";
    }
}

?>
</body>
</html>