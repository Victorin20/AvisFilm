<?php require('buttons/ignorer_action.php'); ?>
<?php include("includes/head.php");?>

    <title>Ignorer le signalement</title>
    <link rel="stylesheet" href="assets/css/signales.css"/>
</head>
<body>
<form action="avis_signales.php">
<input type="image" src="assets/images/return.png" class="return"/>
</form>

    <h1>Êtes vous sur de vouloir ignorer cette avis ?</h1>
    <form method="post">
        <input type=submit name="valider" class="valider" value='valider' />
        <input type=submit name="refuser" class="refuser" value='refuser' />
    </form>

    
<?php include("includes/footer.php");?>
