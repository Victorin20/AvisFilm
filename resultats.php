<?php
require('actions/database.php');
if(empty($_SESSION))header('Location: index.php');
if(!empty($_SESSION))$_SESSION['page_precedente'] = search_page($_SERVER['REQUEST_URI']);
if(!empty($_SESSION))
{
    if(isset($_SESSION['film']))unset($_SESSION['film']);
} 

//on met dans un tableau les films retournee par la fonction search, la recherche sera effectue meme si l'utilisateur n'a pas completer les champs dans ce cas on lui affichera tous ce qu'il y a dans la base de donnes -> les films et ses avis
$array = search(intval($_SESSION['annee']),intval($_SESSION['nb_avis']));
    
?>

<!--condition necessaire pour que l'utilisateur ne puisse pas acceder n'inporte qu'elle page s'il n'est pas connecte -->
<?php if(empty($_SESSION))header('Location: index.php');?>

<?php include("includes/head.php");?>
<link rel="stylesheet" href="assets/css/resultats.css"/>
<title>Resultats</title>
</head>
<body>

<!-- button permetant de retrouner a la page de profil sans erreur -->
<form action="profil.php">
<input type="image" src="assets/images/return.png" class="return"/>
</form>
<?php

    //on va afficher tous les films que se retrouvent dans le tableau $array donne par la fonction search
    foreach($array as $value)
    {
        //renouvlement de la requette meme explication que pour la requette $user_request
        $film_request = mysqli_query($connexion, "SELECT * FROM projet_io2.films");
        while($film_result = mysqli_fetch_assoc($film_request))
        {
            if($film_result['film'] === $value)
            {

                //image du film avec un lien vers la page film.php
                echo "<a href=\"film.php?film={$film_result['film']}\">";
                echo "<div id=\"images_films\">";
                echo "<img src=\"assets/photos/" .$film_result['film']. ".jpg\"></div></a>";
                
                //nom et annee du film
                echo '<div id="noms_films">';
                echo $film_result['film'].' ';
                echo $film_result['annee'].'<br>'.'</div>';
            }                                                                                   
        }
    }  
?>
<?php include("includes/footer.php");?>