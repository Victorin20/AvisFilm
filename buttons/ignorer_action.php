<?php 
require ('actions/database.php');


if(isset($_POST['valider']))
{
    $id= $_GET['id'];
    $request = mysqli_prepare($connexion, "UPDATE projet_io2.avis SET signale=0 WHERE id ='$id'");
    mysqli_stmt_execute($request);
   
    header('Location: avis_signales.php'); 
}

elseif(isset($_POST['refuser']))header('Location: avis_signales.php');


