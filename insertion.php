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

            ?>
        </select>
        <p>type de formation:</p>
        <select name="formation">
            <?php
                
            ?>
        </select>
        <p>formateurs par date</p>
            <?php

            ?>
    </form>
</body>
</html>