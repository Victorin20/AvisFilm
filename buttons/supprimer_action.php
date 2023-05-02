<?php 
require('actions/database.php');

if(isset($_POST['valider']))
{

    $request = mysqli_prepare($connexion, "DELETE FROM projet_io2.avis WHERE id = ?" );
    mysqli_stmt_bind_param($request, 'i', $_GET['id']);
    mysqli_execute($request);  

    if($_SESSION['page_precedente'] === "resultats.php")header('Location: resultats.php');
    elseif($_SESSION['page_precedente'] === "avis_signales.php")header('Location: avis_signales.php');
    elseif($_SESSION['page_precedente'] === "film.php")header("Location: film.php?{$_SESSION['film']}");

}

elseif(isset($_POST['refuser']))
{
    if($_SESSION['page_precedente'] === "resultats.php")header('Location: resultats.php');
    elseif($_SESSION['page_precedente'] === "avis_signales.php")header('Location: avis_signales.php');
    elseif($_SESSION['page_precedente'] === "film.php")header("Location: film.php?{$_SESSION['film']}");
}

