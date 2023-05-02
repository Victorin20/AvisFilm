<?php 
require('actions/database.php');

if(!empty($_SESSION))$_SESSION['page_precedente'] = search_page($_SERVER['REQUEST_URI']);

$avis_signale = false;
$once = false;
while($film_result = mysqli_fetch_assoc($film_request))
{
    $filmDejaMis="";

    $avis_request = mysqli_query($connexion, "SELECT * FROM projet_io2.avis");
    while($avis_result = mysqli_fetch_array($avis_request))
    {
     
        if($avis_result['signale'] == 1)
        {
            $avis_signale = true;
                if($avis_result['film'] === $film_result['film'])
                {

                    $autheur = $avis_result['autor_id'];    
                    $users_request = mysqli_query($connexion, "SELECT * FROM projet_io2.users WHERE id = '$autheur'");
                    $users_result = mysqli_fetch_assoc($users_request);
                    
                    if(!$once AND $avis_signale)
                    {
                        ?><h2>Les Avis signalés :</h2><?php 
                        $once = true;    
                    }

                    if(!$filmDejaMis == $film_result['film'])
                    {
                        $filmDejaMis = $film_result['film'];
                        echo '<div id="noms_films">';
                        echo '<h3>'.$film_result['film'].'</h3></div>';
                    }

                    //on affiche l'auteur du commentaire
                    echo '<div id="publicateur">';
                    echo 'Publie par : ' . $users_result['pseudo']. '</div>';


                    //on affiche le commentaire et deux liens qui permetorons soit de supprimer l'avis soit d'ignorer le signalement
                    echo '<div id="avis">';
                    echo $avis_result['contenu'].'</div>';
                    echo "<a href=\"supprimer.php?id={$avis_result['id']}\" style=\"color: red; margin-left:20px;\"><h3 style=\"display:inline\">Supprimer</h3></a>";

                    echo "<a href=\"ignorer.php?id={$avis_result['id']}\" style=\"color: black; margin-left:20px;\"><h3 style=\"display:inline\">Ignorer</h3></a>";
 
                }
      }
    }
}

if(!$avis_signale)
{
    ?><h2>Pas d'avis signalés :</h2><?php                      
}

