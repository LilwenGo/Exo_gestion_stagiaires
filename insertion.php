<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un stagiaire</title>
    <style>

    </style>
</head>
<body>
    <h1>Ajouter un stagiaire</h1>
    <form action="insert.php" method="POST" enctype="multipart/form-data">
        <p>nom:</p><input type="text" name="nom" value="">
        <p>prénom:</p><input type="text" name="prenom" value="">
        <p>nationalité:</p>
        <select name="nationalite">
            <?php
                require_once "connexion.php";
                $sql1 = "SELECT * FROM nationalite";
                $res1 = $c->query($sql1);
                while ($row1 = $res1->fetch()) {
                    echo '<option value="'.$row1["LIBELLE_NATIONALITE"].'">'.$row1["LIBELLE_NATIONALITE"].'</option>';
                }
            ?>
        </select>
        <p>type de formation:</p>
        <select name="formation" id="formation">
            <?php
                $sql2 = "SELECT * FROM type_formation";
                $res2 = $c->query($sql2);
                while ($row2 = $res2->fetch()) {
                    echo '<option value="'.$row2["LIBELLE_TYPE"].'">'.$row2["LIBELLE_TYPE"].'</option>';
                }
            ?>
        </select>
        <p>formateurs par date</p>
            <?php
                require_once "class/Formateurmanager.class.php";
                require_once "class/Formateur.class.php";
                $fm = new Formateurmanager($c);
                $arrf = $fm->getAllFormateurs();
                foreach ($arrf as $val) {
                    $str = '<input type="checkbox" name="formateurs[]" id="formateur'.$val->getId().'" data-metiers="';
                    foreach ($val->getTypes() as $value) {
                        $str .= $value.',';
                    }
                    $str .= '" value="formateur'.$val->getId().'"><label for="formateur'.$val->getId().'">'.$val->getNom().' '.$val->getPrenom().' dans la salle '.$val->getSalle().', début <input type="date" class="formateur'.$val->getId().'" name="fdd'.$val->getId().'" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'">, fin <input type="date" class="formateur'.$val->getId().'" name="fdf'.$val->getId().'" value="'.date("Y-m-d", time() + 90 * 24 * 3600).'" value="'.date("Y-m-d").'"></label><br>';
                    echo $str;
                }
            ?>
        <input type="submit" name="ok" value="Envoyer">
    </form>
    <a href="affichage.php">Voir stages</a>
    <a href="modification.php">Modifier stagiaire</a>
    <script src="script/insertion.js"></script>
</body>
</html>