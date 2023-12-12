<?php
    require_once "connexion.php";
    require_once "class/Stagemanager.class.php";
    require_once "class/Stage.class.php";
    require_once "class/Formateur.class.php";
    require_once "class/Stagiaire.class.php";
    require_once "class/Stagiairemanager.class.php";
    if(isset($_POST["modifier"])) {
        $stgrm = new Stagiairemanager($c);
        $stgm = new Stagemanager($c);
        //Suprime le stagiaire et ses formations
        $stgrm->delete($_POST["modifier"]);
        foreach ($_POST["modifier"] as $stgrancientid) {
            $stgr = new Stagiaire();
            $stgr->setNom(htmlspecialchars($_POST["nom".$stgrancientid]));
            $stgr->setPrenom(htmlspecialchars($_POST["prenom".$stgrancientid]));
            $stgr->setNationalite(htmlspecialchars($_POST["nationalite".$stgrancientid]));
            $stgr->setTypeFormation(htmlspecialchars($_POST["formation".$stgrancientid]));
            //Récupère l'id d'insertion
            $stgrid = $stgrm->insert($stgr);
            $stgr->setId($stgrid);
            foreach($_POST["formateurs".$stgrancientid] as $val2) {
                //Je convertis l'id html entier en tableau pour faire des traitements individuels
                $tmparr = explode(",", $val2);
                $tmpstr = $tmparr[0];
                //Récupère l'id bdd du formateur que j'ai stocké dans son id html (premier morceau) "exemple id='formateur1'"
                $id = substr($tmpstr, 9, strlen($tmpstr));
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
                    $stg->setDateD($_POST["fdd".$id.",".$stgrancientid]);
                    $stg->setDateF($_POST["fdf".$id.",".$stgrancientid]);
                    //Réinsère un nouveau stagiaire et ses formations
                    $stgm->insert($stg);
                }
            }
        }
    }
    header("Location: affichage.php");
?>