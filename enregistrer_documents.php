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
    $vehicule_id = $_POST['vehicule'];
    $nom_document = $_POST['nom_document'];
    $date_expiration = $_POST['date_expiration'];
    
    // Vérification de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo']['tmp_name'];
        $photoContent = addslashes(file_get_contents($photo));

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['photo']['type'], $allowedTypes)) {
            echo "<p>Type de fichier non autorisé.</p>";
            exit();
        }

        $sql = "INSERT INTO documents (vehicule_id, nom_document, date_expiration, photo) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $vehicule_id, $nom_document, $date_expiration, $photoContent);

        if ($stmt->execute()) {
            echo "<p>Document enregistré avec succès.</p>";
        } else {
            echo "Erreur: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<p>Erreur lors du téléchargement de la photo.</p>";
    }
}

$sql = "SELECT id, numero_immatriculation FROM vehicules";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement d'un Document</title>
</head>
<body>
    <h2>Enregistrement d'un Nouveau Document</h2>
    <form action="enregistrer_documents.php" method="post" enctype="multipart/form-data">
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

        <label for="nom_document">Nom du Document:</label>
        <input type="text" name="nom_document" id="nom_document" required>

        <label for="date_expiration">Date d'Expiration:</label>
        <input type="date" name="date_expiration" id="date_expiration" required>

        <label for="photo">Photo du Document:</label>
        <input type="file" name="photo" id="photo" accept="image/*" required>

        <button type="submit" class="save-button">Enregistrer le Document</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>