<?php
require('database.php');
if(empty($_SESSION))header('Location: index.php');
if(!empty($_SESSION))$_SESSION['page_precedente'] = search_page($_SERVER['REQUEST_URI']);

$film;

if(isset($_GET['film']))$film = $_GET['film'];

if(!isset($_SESSION['film']))$_SESSION['film'] = $film;

if(!isset($film))$film = $_SESSION['film'];


$film_request = mysqli_query($connexion, "SELECT film,annee FROM projet_io2.films WHERE film = '$film'");
$film_result = mysqli_fetch_assoc($film_request);

$film = $film_result['film'];

$avis_result = mysqli_fetch_assoc($avis_request);


$user_request = mysqli_query($connexion, "SELECT pseudo,id FROM projet_io2.users");

$clicked_deposer_avis = isset($_POST['deposer_avis']);

$errorMsg = null;
$avis_depose = null;
$user_id = null;
$_SESSION['avis_ajoute'] = false;

if(isset($_POST['deposer']) )
{
  if(strlen($_POST['text']) < 3)$errorMsg = "l'avis est trop court...";
  
  elseif(!empty($_POST['text']) AND strlen($_POST['text']) > 2){
    
    $avis_depose = $_POST['text'];
    $film = $film_result['film'];
    $user_id = intval($_SESSION['id']);
    
    
  }
  
  //on verifi si l'utilisateur n'a pas donnee deja son avis sur le film en cause oui on a fait en sorte que l'utilisateur puisse donner qu'une seule fois son avis sur le film a condition que l'administrateur n'efface pas son avis dans ce cas il pourra remetre un avis a nouveau
  $avis_request = mysqli_query($connexion, "SELECT autor_id, film FROM projet_io2.avis WHERE autor_id = '$user_id' AND film = '$film'");
  if($avis_result = mysqli_fetch_array($avis_request))$errorMsg = "Vous avez deja donne votre avis sur ce filme...";
  
}

$avis_request = mysqli_query($connexion, "SELECT * FROM projet_io2.avis WHERE film ='$film'");
if($errorMsg === null && isset($_POST['deposer']))
{
  $request = mysqli_prepare($connexion, "INSERT INTO projet_io2.avis(autor_id,contenu, film)VALUES(?, ?, ?)");
  
  mysqli_stmt_bind_param($request, 'iss', $user_id, $avis_depose, $film);

  mysqli_stmt_execute($request);

  $_SESSION['avis_ajoute'] = true;

}


 //si il y a eu une erreur jusque ici on l'afiche
 if(isset($errorMsg))error($errorMsg);

    

    