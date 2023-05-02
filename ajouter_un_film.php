<!--condition necessaire pour que l'utilisateur ne puisse pas acceder n'inporte qu'elle page s'il n'est pas connecte -->
<?php require ('buttons/ajouter_un_film_action.php'); ?>
<?php if(empty($_SESSION))header('Location: index.php');?>
<?php if($_SESSION['is_admin'] != 1)header('Location: profil.php');?>

<?php include("includes/head.php");?>

    <link rel="stylesheet" href="assets/css/ajouter_un_film.css"/>
    <title>Ajouter un film sur site</title>
</head>
<body>
<?php if(isset($errorMsg))error($errorMsg);?>
<?php if(isset($ajoute_succes))succes($ajoute_succes);?>



        <form method="POST" enctype="multipart/form-data">

            <h2>Titre du film</h2><input type="text" name="film">
            <h2>Annee</h2><input type="text" name="annee">
            <h2>Photo</h2><input type="file" name="upload_file">
            <input type="submit" name="valider" value="Ajouter le film sur le site">

        </form>

<form action="profil.php">
<input type="image" src="assets/images/return.png" class="return"/>
</form>

<?php include("includes/footer.php");?>