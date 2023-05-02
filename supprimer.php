<?php require('buttons/supprimer_action.php');?>
<?php if($_SESSION['is_admin'] != 1)header('Location: profil.php');?>
<?php include("includes/head.php");?>

    <title>Supprimer un avis</title>
    <link rel="stylesheet" href="assets/css/signales.css"/>
</head>
<body>

    
    <h1> Êtes vous sur de vouloir supprimer cette avis ?</h1>
    <form method="post">
        <input type=submit name="valider" class="valider" value='valider' />
        <input type=submit name="refuser" class="refuser" value='refuser' />
    </form>


<?php include("includes/footer.php");?>