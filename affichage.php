<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage/supression</title>
    <style>
        table, tr, th, td {
            border-width: 1px;
            border-style: solid;
            border-color: gray;
        }
    </style>
</head>
<body>
    <h1>Stages</h1>
    <form action="supr.php" method="POST" enctype="multipart/form-data">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nationalité</th>
                <th>Type de formation</th>
                <th>Formateur - Salle - Date début - Date fin</th>
                <th>supression</th>
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
                    echo "<tr><td>".$val->getNom()."</td><td>".$val->getPrenom()."</td><td>".$val->getNationalite()."</td><td>".$val->getTypeFormation()."</td><td>";
                    foreach ($ligne = $stgm->getStages($val) as $value) {
                        echo $value->getFormateur()->getNom()." - ".$value->getFormateur()->getSalle()." - ".$value->getDateD()." - ".$value->getDateF()."<br>";
                    }
                    echo '</td><td><input type="checkbox" name="suprimer[]" value="'.$val->getId().'"></td></tr>';
                }
            ?>
        </tbody>
    </table>
    <input type="submit" name="del" value="Suprimer">
    </form>
    <a href="insertion.php">Ajouter stagiaire</a><br>
    <a href="modification.php">Modifier stagiaire</a>
</body>
</html>