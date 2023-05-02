<?php
require('../actions/database.php');

//variable declare pour savoir sur qu'elle page redireger l'uttilisateur apres qu'il a choisi d'effacer un avis si il a valide le formulaire il sera redirige vers la page qu'il a vu juste avant
$_SESSION['page_precedente'] = search_page($_SERVER['REQUEST_URI']);

    $annee; $nb_avis;
    
    //si l'utilisateur n'a pas rempli un ou les champs on mettera des valeurs par defaut pour pouvoir executer la foncrion search
    if(!isset($_GET['annee']))$annee = 0;
    else $annee = $_GET['annee'];
    if(!isset($_GET['nb_avis']))$nb_avis = 0;
    else $nb_avis = $_GET['nb_avis'];

    $_SESSION['annee'] = $annee;
    $_SESSION['nb_avis'] = $nb_avis;
 
header('Location: ../resultats.php');





