
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vehicules";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$today = date("Y-m-d");
$alert_date = date("Y-m-d", strtotime($today. ' + 30 days'));

$type_document = isset($_GET['type_document']) ? $_GET['type_document'] : '';

$sql = "SELECT vehicules.numero_immatriculation, documents.nom_document, documents.date_expiration 
        FROM documents 
        JOIN vehicules ON documents.vehicule_id = vehicules.id 
        WHERE documents.date_expiration <= '$alert_date'";

if ($type_document) {
    $sql .= " AND documents.nom_document = '$type_document'";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='notification'>
                <strong>Attention:</strong> Le document '" . $row["nom_document"] . "' du véhicule " . $row["numero_immatriculation"] . " expire le " . $row["date_expiration"] . ".
              </div>";
    }
} else {
    echo "<p class='alert'>Aucun document n'est proche de l'expiration pour ce type.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications d'Expiration</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="reset.min.css">
</head>
<body>
    <h2>Documents Proches de l'Expiration</h2>
    <form method="get" action="notifications.php">
        <label for="type_document">Type de Document:</label>
        <select name="type_document" id="type_document">
            <option value="">Tous</option>
            <option value="Assurance">Assurance</option>
            <option value="Contrôle Technique">Contrôle Technique</option>
            <option value="permis">Permis</option>
            <!-- Ajouter d'autres types de documents ici -->
        </select>
        <button type="submit" class="save-button">Filtrer</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='notification'>
                    <strong>Attention:</strong> Le document '" . $row["nom_document"] . "' du véhicule " . $row["numero_immatriculation"] . " expire le " . $row["date_expiration"] . ".
                  </div>";
        }
    } else {
        echo "<p>Aucun document n'est proche de l'expiration pour ce type.</p>";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>