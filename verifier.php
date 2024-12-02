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

$sql = "SELECT id, numero_immatriculation FROM vehicules";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement de Vérification</title>
</head>
<body>
    <h2>Enregistrer une Vérification Journalière</h2>
    <form action="enregistrer_verification.php" method="post" id="form_verify">
        <label for="vehicule">Véhicule:</label>
        <select name="vehicule" id="vehicule" required>
            <option value="">Sélectionnez un véhicule</option>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['numero_immatriculation']) . "</option>";
                    }
                }
            ?>
        </select>

        <button type="submit" class="save-button">Enregistrer</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>