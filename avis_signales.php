
<?php include "includes/head.php"; ?>
<title>Avis Signalés</title>
<link rel="stylesheet" href="assets/css/signales.css"/>
</head>
<body>
    <!-- button permetant de retrouner a la page de profil sans erreur -->
    <form action="profil.php">
        <input type="image" src="assets/images/return.png" class="return"/>
    </form>
    
    
    
    <?php require('buttons/avis_signalee_action.php');?>
    <?php if($_SESSION['is_admin'] != 1)header('Location: profil.php');?>
    <?php if(empty($_SESSION))header('Location: index.php');?>
    


<?php include("includes/footer.php");?>