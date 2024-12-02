<?php
session_start(); // Démarrer la session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vehicules";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];

    // Requête pour récupérer l'utilisateur
    $sql = "SELECT * FROM admins WHERE username='$admin_username'";
    $result = $conn->query($sql);

    // Vérifier si l'utilisateur existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Vérifier le mot de passe
        if (password_verify($admin_password, $row['password'])) {
            // Authentification réussie, stocker le nom d'utilisateur dans la session
            $_SESSION['admin'] = $admin_username;
            header("Location: index.php"); // Rediriger vers le tableau de bord
            exit();
        } else {
            echo "<p style='color:red;'>Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p style='color:red;'>Utilisateur non trouvé.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h2>Connexion Admin</h2>
    <form action="login.php" method="post" id="form_login">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" required>
        
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" class="save-button">Se connecter</button>
    </form>

    <p>Pas encore inscrit ? <a href="signup.php">Inscrivez-vous ici</a></p> <!-- Lien vers la page d'inscription -->
</body>
</html>