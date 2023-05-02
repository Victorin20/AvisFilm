<?php 
require ('database.php');

if(isset($_POST['valider']))
{
    $film_signale= $_SESSION['film'];
    $request = mysqli_prepare($connexion, "UPDATE projet_io2.avis SET signale=1 WHERE film = '$film_signale'");
    mysqli_stmt_execute($request);
    header("Location: film.php?{$_SESSION['film']}");
}

elseif(isset($_POST['refuser'])) header("Location: film.php?{$_SESSION['film']}");

