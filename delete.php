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

    // Requête pour supprimer le document
    $sql = "DELETE FROM documents WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Document supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID du document non fourni.";
}

$conn->close();
?>