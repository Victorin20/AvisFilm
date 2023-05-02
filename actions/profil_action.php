<?php
require('database.php');
if(empty($_SESSION))header('Location: index.php');
    //si c'est l'administrateur qui est connecter on fait afficher le button d'ajout des films
   //et le boutton permetant de voir les avis signales
   if($_SESSION['is_admin'] == 1)
   {
     echo '<form action="ajouter_un_film.php">';
     echo '<input type="image" src="assets/images/ajouter_un_film.png" class="ajouter_un_film"/></form>';
   
     echo '<form action="avis_signales.php">';
     echo '<input type="image" src="assets/images/avis_signales.png" class="avis_signales"/></form>';
   }

   echo '<h1 id="mes_derniers_avis">Mes derniers avis :</h1>';
   echo '<h1 id="nom_utilisateur">'.$_SESSION['pseudo'].'</h1>';

   echo '<section id="sect1">';


while($avis_result = mysqli_fetch_assoc($avis_request))
{
  $film_affiche = false;
  
  $film_request = mysqli_query($connexion, "SELECT * FROM projet_io2.films");
  while($film_result = mysqli_fetch_assoc($film_request))
  {
    if(intval($avis_result['autor_id']) === intval($_SESSION['id']))
    {

      if($avis_result['film'] === $film_result['film'])
      {
        
        if(!$film_affiche)
        {                 
          echo '<div id="images_films">
          <img src="assets/photos/'.$film_result['film'].'.jpg">'.'</div>';
          
          echo '<div id="noms_films">';
          echo $film_result['film'].' ';
          echo $film_result['annee'].'<br>'.'</div>';

          $film_affiche = true;       
        }
                
        $contenu = align($avis_result['contenu']);
        echo '<div id="avis">';
        echo $contenu.'</div>';           
      }
    }
  }  
}