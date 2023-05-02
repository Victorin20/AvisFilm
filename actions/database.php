<?php
if(session_status() !== PHP_SESSION_ACTIVE)session_start();
require('functions.php');
      
$GLOBALS['database_hostname'] = 'localhost';
$GLOBALS['database_username'] = 'root';
$GLOBALS['database_password'] = '';
$GLOBALS['database_name'] = 'projet_io2';


    if(!$connexion = mysqli_connect($GLOBALS['database_hostname'], $GLOBALS['database_username'],$GLOBALS['database_password'],$GLOBALS['database_name']))die("Pas de connextion a la base de donnes ");

    //cette requete va servir a afficher les films dans la page de profil, sur lequelle l'utilisateur a donner ses  dernier avis
    $film_request = mysqli_query($connexion, "SELECT * FROM projet_io2.films");
    
    //cette requette va servir a afficher le contenu des derniers avis dans la page de profil
    //c'est pour cela qu'on les sort par ordre decroissant
    $avis_request = mysqli_query($connexion, "SELECT * FROM projet_io2.avis ORDER BY id DESC LIMIT 4");
    
  

    
    
    
