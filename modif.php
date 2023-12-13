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
        $stgm->delete($_POST["modifier"]);
        foreach ($_POST["modifier"] as $stgrid) {
            $stgr = new Stagiaire();
            $stgr->setId($stgrid);
            $stgr->setNom(htmlspecialchars($_POST["nom".$stgrid]));
            $stgr->setPrenom(htmlspecialchars($_POST["prenom".$stgrid]));
            $stgr->setNationalite(htmlspecialchars($_POST["nationalite".$stgrid]));
            $stgr->setTypeFormation(htmlspecialchars($_POST["formation".$stgrid]));
            //Execute la modif
            $stgrm->update($stgr);
            foreach($_POST["formateurs".$stgrid] as $val2) {
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
                    $stg->setDateD($_POST["fdd".$id.",".$stgrid]);
                    $stg->setDateF($_POST["fdf".$id.",".$stgrid]);
                    //Réinsère un nouveau stagiaire et ses formations
                    $stgm->insert($stg);
                }
            }
        }
    }
    header("Location: affichage.php");
?>