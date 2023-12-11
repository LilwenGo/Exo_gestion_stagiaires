<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <style>
        table, tr, th, td {
            border-width: 1px;
            border-style: solid;
            border-color: gray;
        }
    </style>
</head>
<body>
    <h1>Modifier stages</h1>
    <form action="modif.php" method="POST" enctype="multipart/form-data">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nationalité</th>
                <th>Type de formation</th>
                <th>Formateur - Salle - Date début - Date fin</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once "connexion.php";
                require_once "class/Stagemanager.class.php";
                require_once "class/Stage.class.php";
                require_once "class/Formateur.class.php";
                require_once "class/Stagiaire.class.php";
                require_once "class/Stagiairemanager.class.php";
                $stgrm = new Stagiairemanager($c);
                $stgm = new Stagemanager($c);
                $arr = $stgrm->getAllStagiaires();
                foreach ($arr as $val) {
                    echo '<tr><td><input type="text" name="nom'.$val->getId().'" value="'.$val->getNom().'"></td><td><input type="text" name="prenom'.$val->getId().'" value="'.$val->getPrenom().'"></td><td><select name="nationalite'.$val->getId().'">';
                    $arr1 = $stgrm->getAllNationalites();
                    foreach ($arr1 as $v) {
                        if($val->getNationalite() === $v) {
                            echo '<option value="'.$v.'" selected>'.$v.'</option>';
                        } else {
                            echo '<option value="'.$v.'">'.$v.'</option>';
                        }
                    }
                    echo '</select></td><td><select name="formation'.$val->getId().'" id="formation" class="'.$val->getId().'">';
                    $arr2 = $stgrm->getAllTypeFormations();
                    foreach ($arr2 as $v) {
                        if($val->getTypeFormation() === $v) {
                            echo '<option value="'.$v.'" selected>'.$v.'</option>';
                        } else {
                            echo '<option value="'.$v.'">'.$v.'</option>';
                        }
                    }
                    echo '</select></td><td>';
                    require_once "class/Formateurmanager.class.php";
                    require_once "class/Formateur.class.php";
                    $fm = new Formateurmanager($c);
                    $arrf = $fm->getAllFormateurs();
                    foreach ($arrf as $val2) {
                        $str = '<input type="checkbox" name="formateurs'.$val->getId().'[]" id="formateur'.$val2->getId().','.$val->getId().'" data-metiers="';
                        foreach ($val2->getTypes() as $value) {
                            $str .= $value.',';
                        }
                        $ligne = $stgm->getDates($val, $val2);
                        if($ligne->getDateD() && $ligne->getDateF()) {
                            $dated = new DateTime($ligne->getDateD());
                            $datef = new DateTime($ligne->getDateF());
                            $str .= '" value="formateur'.$val2->getId().','.$val->getId().'"><label for="formateur'.$val2->getId().','.$val->getId().'">'.$val2->getNom().' - '.$val2->getSalle().' - <input type="date" class="formateur'.$val2->getId().','.$val->getId().'" name="fdd'.$val2->getId().','.$val->getId().'" value="'.$ligne->getDateD().'" min="'.$ligne->getDateD().'"> - <input type="date" class="formateur'.$val2->getId().','.$val->getId().'" name="fdf'.$val2->getId().','.$val->getId().'" value="'.$ligne->getDateF().'" value="'.$ligne->getDateF().'"></label><br>';
                        } else {
                            $str .= '" value="formateur'.$val2->getId().','.$val->getId().'"><label for="formateur'.$val2->getId().','.$val->getId().'">'.$val2->getNom().' - '.$val2->getSalle().' - <input type="date" class="formateur'.$val2->getId().','.$val->getId().'" name="fdd'.$val2->getId().','.$val->getId().'" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'"> - <input type="date" class="formateur'.$val2->getId().','.$val->getId().'" name="fdf'.$val2->getId().','.$val->getId().'" value="'.date("Y-m-d", time() + 90 * 24 * 3600).'" value="'.date("Y-m-d").'"></label><br>';
                        }
                        echo $str;
                    }
                    echo '</td><td><input type="checkbox" name="modifier[]" value="'.$val->getId().'"></td></tr>';
                }
            ?>
        </tbody>
    </table>
    <input type="submit" name="upd" value="Modifier">
    </form>
    <a href="insertion.php">Ajouter stagiaire</a><br>
    <a href="affichage.php">Voir stagiaires</a>
    <script src="script/modification.js"></script>
</body>
</html>