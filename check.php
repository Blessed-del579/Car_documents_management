<?php
session_start();

function checkAuth() {
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit();
    }
}
?>