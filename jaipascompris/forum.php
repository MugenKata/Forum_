<?php
require('config.php'); /* Contient la connexion à la $bdd */
$Categorie = $bdd->query('SELECT * FROM Categorie ORDER BY Theme');
$sujet = $bdd->prepare('SELECT * FROM sujet WHERE id_Cat = ? ORDER BY titre');
require('forum.view.php');
?>