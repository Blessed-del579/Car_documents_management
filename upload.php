<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si non connecté
    exit();
}
?>
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
    $vehicule_id = $_POST['vehicule'];
    $nom_document = $_POST['nom_document'];
    $date_expiration = $_POST['date_expiration'];
    
    $photo = $_FILES['photo']['tmp_name'];
    $photoContent = addslashes(file_get_contents($photo));

    $sql = "INSERT INTO documents (vehicule_id, nom_document, date_expiration, photo) VALUES ('$vehicule_id', '$nom_document', '$date_expiration', '$photoContent')";

    if ($conn->query($sql) === TRUE) {
        echo "Document téléchargé avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>