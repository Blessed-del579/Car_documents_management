
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vehicules";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST['username'];
    $admin_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins (username, password) VALUES ('$admin_username', '$admin_password')";

    // $sql2 = "SELECT * FROM admins WHERE username='$admin"
    // $result = 

    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie. <a href='login.php'>Connectez-vous ici</a>";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Admin</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h2>Inscription Admin</h2>
    <form action="signup.php" method="post" id="form_signup">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" required>
        
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" class="save-button">S'inscrire</button>
    </form>
</body>
</html>