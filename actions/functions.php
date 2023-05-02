<?php

//fonction permetant de verifier si l'utilisateur a entre un mot de passe au minumum securisee 'une majuscule, une chiffre une minuscule...', qu'il a rentre un vrai format de mail et que son prenom, nom, mail, pseudo ne sont pas tres courtes ou tres longues
function format_valid(string $nom, string $prenom, string $mail, string $pseudo, string $password): string
{
   
    if(strlen($pseudo) < 4)$error = "Veuillez entrer au moins 4 characteres pour le pseudo...";
    elseif(strlen($pseudo) > 50)$error = "Votre pseudo est trop long...";

    if(strlen($prenom) < 4)$error = "Veuillez entrer au moins 4 characteres pour le prenom...";
    elseif(strlen($prenom) > 50)$error ="Votre prenom est trop long...";

    if(strlen($nom) < 4)$error = "Veuillez entrer au moins 4 characteres pour le nom...";
    elseif(strlen($nom) > 50)$error = "Votre nom est trop long...";

    if(strlen($_POST['mail']) < 5)$error ="Votre adresse mail est trop courte...";
    elseif(strlen($_POST['mail']) > 50)$error = "Votre adresse mail est trop longue...";
    elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))$error = "Mauvais format de l'adresse mail !";
    
    if(strlen($password) < 8)$error = "Votre mot de passe doit comporter au moins 8 characteres";
    elseif(strlen($password) > 50)$error = "Votre mot de passe est trop long...";
    
    elseif(!preg_match('#[a-z]+#', $password))$error = "Votre mot de passe doit comporter au moins une lettre minuscule...";
    
    elseif(!preg_match('#[A-Z]+#', $password))$error = "Votre mot de passe doit comporter au moins une lettre majuscule...";
    
    elseif(!preg_match('#[0-9]+#', $password))$error = "Votre mot de passe doit comporter au moins un chiffre...";

    if(isset($error))return $error;
    return "";

}

//fonction permetant de verifier si le mail et le pseudo rentre par l'utilisateur a l'inscription ne sont pas deja utilise sur le site 
function already(string $mail, string $pseudo): string
{
    if(!$connexion = mysqli_connect($GLOBALS['database_hostname'], $GLOBALS['database_username'],$GLOBALS['database_password'],$GLOBALS['database_name']))die("Pas de connexion au serveur");

    $request = mysqli_query($connexion, "SELECT mail,pseudo FROM projet_io2.users");
    
    while($result = mysqli_fetch_assoc($request))
    {
        if(strtolower($result['mail']) === strtolower($mail)) return "Votre mail est deja enregistree sur le site...";
        elseif(strtolower($result['pseudo']) === strtolower($pseudo))return "Le pseudo est deja occupe...";
    }
    return "";
}

//fonction permetant de chercher des films sur les 2 criteres passe en parametres 
function search(int $annee, int $nombre_avis):array
{

    if(!$connexion = mysqli_connect($GLOBALS['database_hostname'], $GLOBALS['database_username'],$GLOBALS['database_password'],$GLOBALS['database_name']))die("Pas de connexion au serveur");

    //on verifie si on a donne une annee paramettre pour pouvoir selectioner les films seulement sur le critere deuxieme critere 
    if($annee > 0)
    {
        $film_request = mysqli_query($connexion, "SELECT film FROM projet_io2.films WHERE annee = $annee");    
    }
    else $film_request = mysqli_query($connexion, "SELECT film FROM projet_io2.films");

    $avis_request = mysqli_query($connexion, "SELECT film FROM projet_io2.avis");

    $nombre_avis_request = 0;
    
    $array = [];
    
    while($film_result = mysqli_fetch_assoc($film_request))
    {
        //renouvlement de la requete
        $avis_request = mysqli_query($connexion, "SELECT film FROM projet_io2.avis");

            while($avis_result = mysqli_fetch_assoc($avis_request))
            {
                //on calcule combien d'avis a le film selectionee
                if($avis_result['film'] === $film_result['film'])$nombre_avis_request++;   
                
            }
             
        if($nombre_avis_request >= $nombre_avis)$array[] = $film_result['film'];
        
        $nombre_avis_request = 0;

    }
    return $array;
}

//fonction obligatoire pour eviter les injections malveillant, enlever les antislashs d'une chaine et les espaces au debut de la chaise et en fin de chaine.
function verify_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = mysqli_real_escape_string($data);
    return $data;
}

//fonction affichant le message donne en parametre
function error($errorMsg)
{
    ?><div class="error"><?=$errorMsg?></div><?php
}
//fonction affichant le message donne en parametre
function succes($succes)
{
    ?><div class="succes"><?=$succes?></div><?php
}


//fonction permetant de faire des saut a la ligne pour les commentaire qui depasse 40 characteres pour eviter d'afficher un commentaire de 100 characteres en une seule ligne
function align($contenu):string
{
    if(strlen($contenu) > 40)
    {
        $contenu_finale = "";
        $copy_contenu = $contenu;
        $position = 0;//index de la position sur une ligne du commentaire

        for($i = 0; $i < strlen($contenu); $i++, $position++)
        {
            //si on trouve un espace et que on a deje depasse le 38eme character on rajoute un saut a la ligne
            if($copy_contenu[$i] === ' ' AND $position > 40)
            {
                $contenu_finale .= "<br>";
                $position = 0;
            }
            if($position > 45)
            {
                $contenu_finale .= "<br>";
                $position = 0;
            }
                //on rajout lettre par lettre mais la condition d'avant nous permet d'eviter de couper un mot en deux 
                $contenu_finale .=$copy_contenu[$i];
            
        }
        
        return $contenu_finale;
    }
    //si le commentaire ne depasse pas 40 characteres on le retourne sans changement car il n'a pas besoin de retour a la ligne il est assez court pour rentrer en une ligne
    return $contenu;
}

//fonction prenant en argument un url et retroune le nom du fichier ouvert actuelement dans la session
function search_page(string $url):string
{

    $page = "";
    for($i=0; $i < strlen($url); $i++)
    {
        if($url[$i] != '/')$page .= $url[$i];
        elseif($url[$i] === '/')$page ="";

        if($url[$i] === '.')
        {
            
            $page .="php";
            break;
        }
    }

    return $page;
}