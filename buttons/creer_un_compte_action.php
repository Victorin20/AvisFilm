<?php
require('actions/database.php');



//validation du formulaire
if(isset($_POST['valider']))
{
    //verification si l'utilisateur a completer tous les champs
    if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['password']) AND !empty($_POST['pseudo']))
    {
       
        $errorMsg = format_valid($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pseudo'], $_POST['password']);
        $in = "test";

        //les donnes recus de l'utilisateur
        $user_pseudo = verify_input($_POST['pseudo']);
        $user_prenom = verify_input($_POST['prenom']);
        $user_nom = verify_input($_POST['nom']);
        $user_mail = verify_input($_POST['mail']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //verification si le mail ou le pseudo sont deja enregistree dans la base de donnes
        $information_occupe = already($user_mail, $user_pseudo);

        if(strlen($information_occupe) > 0 && strlen($errorMsg) < 1)$errorMsg = $information_occupe;

        //si il n'y a pas d'erreur a rapporter on importer les donnes de l'utilisateur dans la base de donner et le connecter a son profil
       
        if(strlen($errorMsg) < 1)
        {

            //inseration des donnes fournis par l'utilisateur dans la base de donnees
            $request = mysqli_prepare($connexion, 'INSERT INTO projet_io2.users(pseudo, nom, prenom, password, mail)VALUES(?,?,?,?,?)');

            mysqli_stmt_bind_param($request, 'sssss', $user_pseudo, $user_nom, $user_prenom, $user_password, $user_mail);

            mysqli_stmt_execute($request);

            //on reprend les donnes de l'utilisateur importe dans la base de donnes pour les atribuer a la variable globale $_SESSION par ce fait on aura la posibilite d'acceder aux donnes necessaires de l'utilisateur sans passer par une requete
            $request = mysqli_query($connexion, "SELECT id, pseudo, mail, is_admin FROM projet_io2.users WHERE pseudo = '$user_pseudo'");
            
            $result = mysqli_fetch_assoc($request);

            
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $result['pseudo'];
            $_SESSION['mail'] = $result['mail'];
            $_SESSION['is_admin'] = $result['is_admin'];
            
            //rediriger l'utilisateur dans la page de son profil
            header('Location: profil.php');
            
        }     
            
    }
    else $errorMsg = "Veuillez completer tous les champs...";  
}