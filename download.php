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

// Vérifier si l'id du document est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête pour récupérer le document
    $sql = "SELECT nom_document, photo FROM documents WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si le document existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nom_document = $row['nom_document'];
        $photo = $row['photo'];

        // Envoyer les en-têtes pour le téléchargement du fichier
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$nom_document.jpg\"");
        echo $photo; // Envoyer le contenu de la photo
    } else {
        echo "Document introuvable.";
    }

    $stmt->close();
} else {
    echo "ID du document non fourni.";
}

$conn->close();
?>