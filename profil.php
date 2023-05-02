<?php include("includes/head.php");?>
    <title>Profil</title>
    <link rel="stylesheet" href="assets/css/profil.css">
  </head>

  <body>
    <section id="bare_de_recherche">
   <!--  bare de recherche -->
    <form action="buttons/search.php" method="GET">
      
      <input type="image" src="assets/images/search.png" class="search"/>
      
      <input type="text" placeholder="Annee du film"  name="annee" id="search_annee"/>
      <input type="text" placeholder="Nombre d'avis minimal" name="nb_avis" id="nb_avis"/>
    </form>
    </section>
    
    <!-- se deconnecter -->
    <form action="buttons/se_deconnecter.php">
      <input type="image" src="assets/images/se_deconnecter.png" class="se_deconnecter"/>
    </form> 
    
    <img src="assets/images/avatar_default.png"  class="avatar_default"/>
    <img src="assets/images/background_profil.jpg" class="background"/>
    
  <!--condition necessaire pour que l'utilisateur ne puisse pas acceder n'inporte qu'elle page s'il n'est pas connecte -->
  <?php require('actions/profil_action.php')?>
  <?php if(empty($_SESSION))header('Location: index.php');?>
 
 </section>
   
 <?php include("includes/footer.php");?>
