
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vehicules";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$sql = "SELECT vehicules.numero_immatriculation, verifications.date_verification 
        FROM verifications 
        JOIN vehicules ON verifications.vehicule_id = vehicules.id 
        ORDER BY verifications.date_verification DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Vérifications</title>
</head>
<body>
    <table>
        <tr>
            <th>Numéro d'immatriculation</th>
            <th>Date de Vérification</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["numero_immatriculation"] . "</td>
                        <td>" . $row["date_verification"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Aucune vérification trouvée</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>