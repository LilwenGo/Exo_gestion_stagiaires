<?php
    require_once "connexion.php";
    require_once "class/Stagemanager.class.php";
    require_once "class/Stage.class.php";
    require_once "class/Formateur.class.php";
    require_once "class/Stagiaire.class.php";
    require_once "class/Stagiairemanager.class.php";
    $stgm = new Stagemanager($c);
    $stgrm = new Stagiairemanager($c);
    $stgr = new Stagiaire();
    $stgr->setNom(htmlspecialchars($_POST["nom"]));
    $stgr->setPrenom(htmlspecialchars($_POST["prenom"]));
    $stgr->setNationalite(htmlspecialchars($_POST["nationalite"]));
    $stgr->setTypeFormation(htmlspecialchars($_POST["formation"]));
    //Récupère l'id d'insertion pour le reutiliser
    $stgrid = $stgrm->insert($stgr);
    $stgr->setId($stgrid);
    //Boucle pour creer les formations avec les formateurs selectionnés
    foreach($_POST["formateurs"] as $val) {
        $id = substr($val, 9, strlen($val));
        $sql = "SELECT * FROM formateur WHERE ID_FORMATEUR = :id";
        $res = $c->prepare($sql);
        $res->execute(array("id" => $id));
        if($ligne = $res->fetch()) {
            $f = new Formateur();
            $f->setId($id);
            $f->setNom($ligne["NOM"]);
            $f->setPrenom($ligne["PRENOM"]);
            $stg = new Stage();
            $stg->setStagiaire($stgr);
            $stg->setFormateur($f);
            $stg->setDateD($_POST["fdd".$id]);
            $stg->setDateF($_POST["fdf".$id]);
            //Insere la formation
            $stgm->insert($stg);
        }
    }
    header("Location: affichage.php");
?>