<?php
//////////////////////deposer un avis///////////////////////////////
if(isset($_POST['deposer']))
{
    $errorMsg = null;
    if(!empty($_POST['avis_depose']) && strlen($_POST['avis_depose']) > 1 && !empty($_POST['select'])){
        $avis_depose = verify_input($_POST['avis_depose']);
        $film = verify_input($_POST['select']);

        $film[0] = strtoupper($film[0]);
        // on se rassure de mettre la premiere lettre en majustcule au cas ou l'utilisateur ne l'a pas fait car sinon l'avis ne pourra pas etre lu par la suite par la base de donne car la lecture de l'image prend le nom du film et rajoute a la fin le format jpg et c'est cette nom qu'on va chercher dans le dossier photo ou tous les photos des films on le nom commencant par une majuscule

        //si l'utilisateur a vraiment fait une faute importante dans le nom du film on va lui afficher un message d'erreur 

        $user_id = intval($_SESSION['id']);

        $film_request = mysqli_query($connexion, "SELECT film FROM projet_io2.films WHERE film = '$film'");

        //on verifi si l'utilisateur n'a pas donnee deja son avis sur le film en cause oui on a fait en sorte que l'utilisateur puisse donner qu'une seule fois son avis sur le film a condition que l'administrateur n'efface pas son avis dans ce cas il pourra remetre un avis a nouveau
        $avis_request = mysqli_query($connexion, "SELECT autor_id, film FROM projet_io2.avis WHERE autor_id = '$user_id' AND film = '$film'");
        if($avis_result = mysqli_fetch_array($avis_request))$errorMsg = "Vous avez deja donne votre avis sur ce filme...";

        //on affiche le message d'erreur si l'utilisateur s'est trompe dans l'orthographie du nom du film qu'il voulais commente
        if(!$film_result = mysqli_fetch_array($film_request))$errorMsg = "Veuillez entrer le nom du film correctement ...";

        if(isset($errorMsg))error($errorMsg);
    
        //on verifi bien qu'il n'y a eu aucune errore jusque ici si la condition et vrai on insert les donnes dans la base de donnes
        if($errorMsg === null)
        {
            $request = mysqli_prepare($connexion, "INSERT INTO projet_io2.avis(autor_id,contenu, film)VALUES(?, ?, ?)");

            mysqli_stmt_bind_param($request, 'iss', $user_id, $avis_depose, $film);

            mysqli_stmt_execute($request);
        
        }
    
    }
    if($errorMsg === null AND strlen($_POST['avis_depose']) < 2)$errorMsg = "L'avis est trop court...";
    elseif(($errorMsg === null AND empty($_POST['avis_depose'])) OR ($errorMsg === null AND empty($_POST['select'])))$errorMsg = "Veuillez completer tous le champs...";
   
    //si il y a eu une erreur jusque ici on l'afiche
    if(isset($errorMsg))error($errorMsg);

        
        
}
//////////////////////deposer un avis///////////////////////////////

