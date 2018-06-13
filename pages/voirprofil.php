<?php
session_start();
$titre="Profil";

include("../includes/includes.php");
include("../includes/navbar.php");

if (!isset($_SESSION['id'])){
        header('Location: ../index.php');
        exit;
    }
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" type="text/css" title="style" href="../index.css" />
		
	</head>

	<body>
		
				<h1 id="h1">Information du compte</h1>
				<div class="container_profil">
					<a href="reception_mp.php"><button type="button" id="msg_profil" class="btn btn-primary btn-sm">Messagerie</button></a>  <a href="modifier_profil.php"><button type="button" id="modif_profil"class="btn btn-primary btn-sm">Modifier Profil</button></a>
				
				<p><img src="../images/pika.svg" id="pika"></p>

				<div class="info_profil">
					 <p><b>Votre pseudo : </b><?php echo $_SESSION['pseudo'];?></p>
	   					<p><b>Votre adresse e-mail : </b><?php echo $_SESSION['mail'];?> </p>
	   					</div>
	   					</div>
					
	</body>

</html>
