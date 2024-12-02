<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vehicules";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_immatriculation = filter_input(INPUT_POST, 'numero_immatriculation', FILTER_SANITIZE_STRING);
    $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_STRING);
    $modele = filter_input(INPUT_POST, 'modele', FILTER_SANITIZE_STRING);
    $annee = filter_input(INPUT_POST, 'annee', FILTER_VALIDATE_INT);

    $sql = "INSERT INTO vehicules (numero_immatriculation, marque, modele, annee) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $numero_immatriculation, $marque, $modele, $annee);

    if ($stmt->execute()) {
        echo "<p>Véhicule enregistré avec succès.</p>";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement d'un Nouveau Véhicule</title>
</head>
<body>
    <h2>Enregistrement d'un Nouveau Véhicule</h2>
    <form action="enregistrer_vehicules.php" method="post">
        <label for="numero_immatriculation">Numéro d'Immatriculation:</label>
        <input type="text" name="numero_immatriculation" id="numero_immatriculation" required>

        <label for="marque">Marque:</label>
        <input type="text" name="marque" id="marque" required>

        <label for="modele">Modèle:</label>
        <input type="text" name="modele" id="modele" required>

        <label for="annee">Année:</label>
        <input type="number" name="annee" id="annee" required min="1900" max="<?php echo date('Y'); ?>">

        <button type="submit">Enregistrer le Véhicule</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>