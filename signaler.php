<?php require ('actions/filmSignaler_action.php');?>
<?php include("includes/head.php");?>


    <title>Signaler un avis</title>
    <link rel="stylesheet" href="assets/css/signales.css"/>
</head>

<body>

    <h1> Êtes vous sur de vouloir signaler cette avis ?</h1>
    <form method="post">
        <input type=submit name="valider" class="valider" value='valider' />
        <input type=submit name="refuser" class="refuser" value='refuser' />
    </form>


<?php include("includes/footer.php");?>
