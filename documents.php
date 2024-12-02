<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vehicules";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les documents
$sql = "SELECT id, nom_document, date_expiration, photo FROM documents";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Documents</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="reset.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Liste des Documents</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Document</th>
                <th>Date d'Expiration</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nom_document']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date_expiration']) . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['photo']) . "' width='100'></td>";
                    echo "<td>
                            <a href='download.php?id=" . $row['id'] . "'>Télécharger</a> | 
                            <a href='delete_document.php?id=" . $row['id'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce document ?\");'>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun document trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>