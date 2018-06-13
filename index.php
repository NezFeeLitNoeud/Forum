<?php
session_start();
$titre="Connexion";
$titre="Enregistrement";
include("./includes/connexionBD.php");
include_once('./includes/includes.php');

if(isset($_SESSION['pseudo'])){
	header('Location: ./pages/accueil.php');
	exit;
}

if(!empty($_POST)){
	extract($_POST);
	$valid = true;
	
	$Mail = htmlspecialchars(trim($Mail));
	$Password = trim($Password);
		
	if(empty($Mail)){
		$valid = false;
		$_SESSION['flash']['warning'] = "Veuillez renseigner votre mail !";
	}
	
	if(empty($Password)){
		$valid = false;
		$error_password = "Veuillez renseigner un mot de passe !";
	}
	
	
	$req = $DB->query('Select * from user where mail = :mail and password = :password', array('mail' => $Mail, 'password' => crypt($Password, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t')));
	$req = $req->fetch();
		
	if(!$req['mail']){
		$valid = false;
		$_SESSION['flash']['danger'] = "Votre mail ou mot de passe ne correspondent pas";
	}
	
	
	if($valid){
		
		//$_SESSION['id'] = $req['id'];
		$_SESSION['id'] = $req['idpublic'];
		$_SESSION['pseudo'] = $req['pseudo'];
		$_SESSION['mail'] = $req['mail'];
		$_SESSION['password'] = $req['password'];
		
		$_SESSION['flash']['info'] = "Bonjour " . $_SESSION['pseudo'];
		header('Location: ./pages/accueil.php');
		exit;
			
	}
	
}	

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Adopte une culture</title>
	<link rel="stylesheet" href="index.css">
	
</head>
<body>
	<div class="contaiter full-height">
		<div class="signlog full-height">
			<div class="lol">
				<div class="tcenter" id="tit"><h1>Adopte une culture : </h1>
				</div>
				<div class="tcenter" id="accroche">"La culture, c'est comme la confiture : moins on en a, plus on l'étale." <b>Jean Delacour</b>
				</div>
			</div>
			<div class="row2 triple">
				<div class="full-width inscri tcenter">	
					<div class="ins-form">
						<p>Bienvenue cher visiteur,<br><br><br>Si tu souhaite t’endormir moins bête, inscrits toi et rejoins nos petits Einstein.</p><br><br>

					<!-- INSCRIPTION -->
					<p><a href="./pages/inscription.php"><input class="butinscri" id="butinscri" type="submit" value="S'inscrire" /></a></p>
					</div>
				</div>	
				<div class="full-width login tcenter">
				<!-- SE CONNECTER -->	
				<form class="con-form" method="post" action="">
	                    
                        <label>Mail :</label><br><br>
	
                    	<input class="input" type="email" name="Mail" placeholder="Mail" value="<?php if (isset($Mail)) echo $Mail; ?>" required="required">	<br><br>
<br>
						
						
	                    <label>Mot de passe :</label><br><br>
	                    	
                    
						<?php
							if(isset($error_password)){
								echo $error_password."<br/>";
							}	
						?>

                        <input class="input" type="password" name="Password" placeholder="Mot de passe" value="<?php if (isset($Password)) echo $Password; ?>" required="required">

	
	
	                    <div class="btn-con">
	                        
	                        
								<button type="submit" class="butinscri" id="butinscri2">Se connecter !</button>
	                                                
	                   </div>
	
	                </form> 

				</div>
			</div>
			<div class="row2 half">
				<div class="tcenter full-width"><span class="pointer" onclick="cgu()">CGU</span> /<span class="pointer" onclick="about()"> A propos</span> / <span class="pointer" onclick="confi()"> Confidentialité </span>
			</div>
		</div>
	</div>
	<script src="index.js"></script>
</body>
</html>
