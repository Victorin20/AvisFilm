<?php require('buttons/se_connecter_action.php');?>
<?php include("includes/head.php");?>

    <title>Avifilm.net</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="assets/css/index.css"/>

</head>
<body>

<?php if(isset($errorMsg))error($errorMsg);?>

<form method="POST">



<h2>Identifiant:</h2> <input type="text" name="identifiant"><br>
<h2>Mot de passe:</h2> <input type="password" name="password"><br>
<input type="submit" name="se_connecter" value="se connecter">


</form>

<form action="creer_un_compte.php" method="POST">

<input type="submit" name="creer_un_compte" value="creer un compte">
</form>

<img src="assets/images/background_index.jpg" id="background"/>

<?php include("includes/footer.php");?>