<?php 
require('actions/database.php');

//validation du formulaire
if(isset($_POST['valider']))
{
    //verification si l'admin a completer tous les champs
    if(!empty($_POST['film']) AND !empty($_POST['annee']) AND !empty($_FILES['upload_file']))
    {
        $errorMsg=null;
        $ajoute_succes = null;

        //1 mégaoctet
        $maxsize = 1000000;

        if($_FILES['upload_file']['error'] > 0)$errorMsg = "Une erreur est survenu...";

        $filesize = $_FILES['upload_file']['size'];

        if($filesize > $maxsize)$errorMsg="Le fichier depasse la taille maximale de  1 mégaoctet...";

        //les donnes recus par l'admin
        $user_film = verify_input($_POST['film']);
        $user_annee = verify_input($_POST['annee']);

        //il faut que la premier lettre du film soit en majuscule pour pouvoir lire le fichier jpg a l'affichage du film
        $user_film[0] = strtoupper($user_film[0]);

        $nameFile = $_FILES['upload_file']['name'];
        $tmpfile = $_FILES['upload_file']['tmp_name'];
        $extension = explode('.', $nameFile);
        

        //si le fichier n'est pas au format jpg on affichera un erreur
        if(strtolower(end($extension)) !== 'jpg')
        {
            $errorMsg = "Le fichier doit etre au format jpg";
        }

        //si il n'y a pas eu d'erreur jusqu'ici on va charger la photo dans le dossier ou sont stockes les photos de films et on rajoute le nom et l'annee du film dans la base de donnes
        if($errorMsg === null)
        {
           
            if(move_uploaded_file($tmpfile, './assets/photos/' .$user_film. '.' . strtolower(end($extension))))$ajoute_succes = "Le film a ete rajoute avec succes";

            //inseration des donnes fournis par l'admin dans la base de donnees
            $request = mysqli_prepare($connexion, 'INSERT INTO projet_io2.films(film , annee )VALUES(?,?)');
            mysqli_stmt_bind_param($request, 'ss', $user_film, $user_annee);
            mysqli_stmt_execute($request);           
        }          
    }

    else $errorMsg = "Veuillez completer tous les champs...";    
}
