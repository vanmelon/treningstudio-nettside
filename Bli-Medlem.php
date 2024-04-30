<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
</head>
<body>

<h1> Ikke brukernavn? Registrer deg: </h1>
<form method="post">
    <label>epost: <input type="email" name="email"></label>
    <label>Passord: <input type="password" name="password"></label>
    <input type="submit" name="register" value="registrer">
</form>
<br>


<?php
session_start();

// Angi databasedetaljene her
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "prosjekt";

try {
    //kobler til serveren og databasen
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// registrering av ny bruker
if (isset($_POST['register'])) {
    $epost = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT);
    
    try {
        if(empty($epost) || empty($password)){
            echo 'Fyll inn alle felter';
        } else {
            // sjekker om epost finnes
            $sth = $pdo->prepare('SELECT * FROM prosjektledere WHERE epost = ?');
            $sth->execute([$epost]);
            $user = $sth->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "Eposten er allerede i bruk.";
            } else {
                // Oppretter ny bruker
                $sth = $pdo->prepare('INSERT INTO prosjektledere (epost, passord) VALUES (?, ?)');
                if ($sth->execute([$epost, $password])) {
                    // Brukeren ble registrert, omdiriger til en annen side for å unngå form re-submission
                    header("Location: etterRegistrering.php");
                    exit;
                }
            }
        }
        //hvis den mister databasen (se linje 43-44)
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} 
?>
</body>
</html>