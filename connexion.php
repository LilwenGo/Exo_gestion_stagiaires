<?php
    $c = new PDO('mysql:host=127.0.0.1;dbname=stagiairesbdd;charset=utf8mb4', 'root', '');
    $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>