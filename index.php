<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si non connecté
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.min.css">
</head>
<body>
    <div class="app">
        <header class="app-header">
            <div class="app-header-logo">
                <div class="logo">
                    <span class="logo-icon">
                        <img src="almeria-logo.svg" />
                    </span>
                    <h1 class="logo-title">
                        <span>Car Documents</span>
                        <span>Management Dashboard</span>
                    </h1>
                </div>
            </div>
            <div class="app-header-navigation">
			<div class="tabs">
				
			</div>
            </div>
            <div class="app-header-actions">
                <button class="user-profile">
                    <span>Hyacinthe MANIRIHO</span>
                    <span>
                        <img src="profile.svg" /> 
                    </span>
                </button>
            </div>
        </header>
        <div class="app-body">
            <div class="app-body-navigation">
                <nav class="navigation">
                    <a href="?page=enregistrer_vehicules">
                        <span>Enregistrement des véhicules</span>
                    </a>
                    <a href="?page=enregistrer_documents">
                        <span>Enregistrement des documents</span>
                    </a>
                    <a href="?page=verifier">
                        <span>Enregistrement des vérifications des journalières</span>
                    </a>
                    <a href="?page=documents">
                        <span>Gérer les documents</span>
                    </a>
                    <a href="?page=vehicules">
                        <span>Gérer les véhicules</span>
                    </a>
                    <a href="?page=historique_verifications">
                        <span>Gérer les historiques des vérifications</span>
                    </a>
                    <a href="?page=notifications">
                        <span>Gérer les notifications</span>
                    </a>
                    <a href="?page=deconnexion">
                        <span>Déconnexion</span>
                    </a>
                </nav>
                <footer class="footer">
                    <h1>Car Documents Management<small>©</small></h1>
                    <div>
                        Car Documents Management ©<br />
                        All Rights Reserved 2024
                    </div>
                </footer>
            </div>
            <div class="app-body-main-content">
                <section class="service-section">
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        include "$page.php";
                    } else {
                        echo "<h2>Bienvenue sur le tableau de bord</h2>";
                    }
                    ?>
                </section>
                
            </div>
        </div>
    </div>
</body>
</html>