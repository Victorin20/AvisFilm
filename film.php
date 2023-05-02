<?php require('actions/film_action.php');?>

<?php require('includes/head.php');?>

<title>Film</title>
    <link rel="stylesheet" href="assets/css/film.css"/>
</head>

<!-- button permetant de retrouner a la page de profil sans erreur -->
<form action="resultats.php">
<input type="image" src="assets/images/return.png" class="return"/>
</form>

<body>
 
<?php
    echo "<div id=\"images_films\">";
    echo "<img src=\"assets/photos/" .$film_result['film']. ".jpg\"></div></a>";
    
    //nom et annee du film
    echo '<div id="noms_films">';
    echo $film_result['film'].' ';
    echo $film_result['annee'].'</div>';
    
    while($avis_result = mysqli_fetch_assoc($avis_request))
    {
        $user_request = mysqli_query($connexion, "SELECT pseudo,id FROM projet_io2.users");
        $user_pseudo = "";
        //on recherche le pseudo de l'utilisateur qui a poste l'avis
        while($user_result = mysqli_fetch_assoc($user_request))    
        {
            if($user_result['id'] === $avis_result['autor_id'])
            {
                $user_pseudo = $user_result['pseudo'];
            }
            
        }
            
            //on affiche l'avis du film et son auteur
            //on fait appel a la fonction align pour assurer des saut a la ligne apres 40 characteres
            $contenu = align($avis_result['contenu']);
                      
            echo '<div id="avis">';
            echo $contenu.'</div>';
            echo '<div id="publicateur">';
            echo 'Publiée par: '.$user_pseudo.'</div>';
            
            //évité que l'auteur puissent signaler ces propres avis 
            if($avis_result['autor_id'] != $_SESSION['id'])
            {
                echo "<a href=\"signaler.php?id={$avis_result['id']}\" style=\"color: black; margin-left:20px;\"><h3 style=\"display:inline\">Signaler</h3></a>";
            }
            
            //formulaire pour l'administrateur
            if($_SESSION['is_admin'] == 1) 
            {
                echo "<a href=\"supprimer.php?id={$avis_result['id']}\" style=\"color: red; margin-left:20px;\"><h3 style=\"display:inline\">Supprimer</h3></a>"; 
            }
            
        }
        
        echo '<form method="post">';

        echo '<div id="deposer_avis_button">';
        echo '<input type="submit" name="deposer_avis" value="Deposer un avis" >'. '</div>';
        echo '</form>';
        
        if($clicked_deposer_avis)
        {
                      
            echo '<form method="post">';

            echo '<div id = "avis_textarea" >' . '<textarea id="avis_text" type="text" name="text"   cols="50" rows="20">'. '</textarea>'.'<div/>';

            echo '<div id="deposer_button">';

            echo '<input type="submit" name="deposer" value="Deposer" >'. '</div>';
            
            echo '</form>';
        
        }
        
    
    ?>

<?php include("includes/footer.php");?>

