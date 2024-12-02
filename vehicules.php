<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vehicules";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Handle add, edit, delete operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $id = $_POST['id'] ?? null;
    $numero_immatriculation = $_POST['numero_immatriculation'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];

    if ($action == 'add') {
        $sql = "INSERT INTO vehicules (numero_immatriculation, marque, modele) VALUES ('$numero_immatriculation', '$marque', '$modele')";
    } elseif ($action == 'edit' && $id) {
        $sql = "UPDATE vehicules SET numero_immatriculation='$numero_immatriculation', marque='$marque', modele='$modele' WHERE id=$id";
    } elseif ($action == 'delete' && $id) {
        $sql = "DELETE FROM vehicules WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Opération réussie.";
    } else {
        echo "Erreur: " . $conn->error;
    }
}

// Fetch vehicles
$sql = "SELECT * FROM vehicules";
$result = $conn->query($sql);
?>
<table>
    <tr>
        <th>Immatriculation</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Actions</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <form method="post">
                    <td><input type="text" name="numero_immatriculation" value="<?php echo $row['numero_immatriculation']; ?>"></td>
                    <td><input type="text" name="marque" value="<?php echo $row['marque']; ?>"></td>
                    <td><input type="text" name="modele" value="<?php echo $row['modele']; ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="action" value="edit" class="save-button">Modifier</button>
                        <button type="submit" name="action" value="delete" class="save-button">Supprimer</button>
                    </td>
                </form>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Aucun véhicule trouvé</td>
        </tr>
    <?php endif; ?>
</table>

<?php
$conn->close();
?>