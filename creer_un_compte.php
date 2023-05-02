<?php require('buttons/creer_un_compte_action.php');?>
<?php include("includes/head.php");?>

    <title>Creer un compte</title>
    <link rel="stylesheet" href="assets/css/index.css"/>
</head>
<body>

<?php if(isset($errorMsg)){error($errorMsg);}?>

<!-- formulaire d'inscription -->
<form method="post">

<h2>Mail</h2><input type="text" name="mail"><br>
<h2>Nom</h2><input type="text" name="nom"><br>
<h2>Prenom</h2><input type="text" name="prenom"><br>
<h2>Pseudo</h2><input type="text" name="pseudo"><br>
<h2>Mot de passe</h2><input type="password" name="password"><br>

<input type="submit" name="valider" value="creer le compte">
</form>
<!-- formulaire d'inscription -->



<form action="index.php">
<input type="image" src="assets/images/return.png" class="return"/>
</form>

<img src="assets/images/background_index.jpg" id="background"/>
    
<?php include("includes/footer.php");?>