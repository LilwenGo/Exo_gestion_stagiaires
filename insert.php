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
    $stgr->setNom($_POST["nom"]);
    $stgr->setPrenom($_POST["prenom"]);
    $stgr->setNationalite($_POST["nationalite"]);
    $stgr->setTypeFormation($_POST["formation"]);
    $stgrid = $stgrm->insert($stgr);
    $stgr->setId($stgrid);
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
            $stgm->insert($stg);
        }
    }
?>