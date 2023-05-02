<?php
require('actions/database.php');


//validation du formulaire
if(isset($_POST['se_connecter']))
{
    $errorMsg = null;
    //verification si l'utilisateur a completer tous les champs
    if(!empty($_POST['identifiant']) AND !empty($_POST['password']))
    {
        //les donnes recus de l'utilisateur
        $user_identifiant = $_POST['identifiant'];
        $user_password = $_POST['password'];

        $request = mysqli_query($connexion, "SELECT * FROM projet_io2.users WHERE mail = '$user_identifiant' OR pseudo = '$user_identifiant'");
	    if(!$result = mysqli_fetch_assoc($request))$errorMsg = "Aucun utilisateur ne correspond.";
       
        if($errorMsg === null)
        {
            if(password_verify($user_password, $result['password']))
            {
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $result['id'];
                $_SESSION['pseudo'] = $result['pseudo'];
                $_SESSION['mail'] = $result['mail'];
                $_SESSION['is_admin'] = $result['is_admin'];
                
                header('Location: profil.php');  
            }
            
            else $errorMsg = "Votre mot de passe est incorrect...";
              
        }

    }

    else $errorMsg = "Veuillez completer tous les champs...";
    
}