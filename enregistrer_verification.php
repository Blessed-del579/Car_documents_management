
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
    $date_verification = date("Y-m-d");

    $sql = "INSERT INTO verifications (vehicule_id, date_verification) VALUES ('$vehicule_id', '$date_verification')";

    if ($conn->query($sql) === TRUE) {
        echo "Vérification enregistrée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>