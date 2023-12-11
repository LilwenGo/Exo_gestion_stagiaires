<?php
    if(isset($_POST["suprimer"])) {
        require_once "connexion.php";
        require_once "class/Stagiairemanager.class.php";
        $stgrm = new Stagiairemanager($c);
        $stgrm->delete($_POST["suprimer"]);
    }
    header("Location: affichage.php");
?>