<?php
session_start();
include_once('../includes/includes.php');

if(isset($_SESSION['pseudo'])){
	header('Location: accueil.php');
	exit;
}

if(!empty($_POST)){
	extract($_POST);
	$valid = true;
	
	$Mail = htmlspecialchars(trim($Mail));
	$Pseudo = htmlspecialchars(ucfirst(trim($Pseudo)));
	$Password = trim($Password);
	$PasswordConfirmation = trim($PasswordConfirmation);
		
	if(empty($Pseudo)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un pseudo !";
	}
	
	if(empty($Mail)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un mail !";
	}
	
	$req = $DB->query('Select mail from user where mail = :mail', array('mail' => $Mail));
	$req = $req->fetch();
	
	if(!empty($Mail) && $req['mail']){
		$valid = false;
		$_SESSION['flash']['danger'] = "Ce mail existe déjà";
		
	}
	if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $Mail)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez mettre un mail conforme !";
	}
	
	if(empty($Password)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez renseigner votre mot de passe !";

	}elseif($Password && empty($PasswordConfirmation)){
		$valid = false;
		$_SESSION['flash']['danger'] = "Veuillez confirmer votre mot de passe !";
	
	}elseif(!empty($Password) && !empty($PasswordConfirmation)){
		if($Password != $PasswordConfirmation){
			
			$valid = false;
			$_SESSION['flash']['danger'] = "La confirmation est différente !";
		}
		
	}
		
	if($valid){
		
		$id_public = uniqid();
		
		$DB->insert('INSERT INTO user (pseudo, mail, password, idpublic) values (:pseudo, :mail,:password, :idpublic)', array('pseudo' => $Pseudo, 'mail' => $Mail, 'password' => crypt($Password, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t'), 'idpublic' => $id_public));

		
		$_SESSION['flash']['success'] = "Votre inscription a bien été prise en compte, connectez-vous !";
		header('Location: ../includes/connexion.php');
		exit;
		
	}	
}	
?>

<!DOCTYPE html>
<html lang="fr">
	<header>
	
		<link href="../index.css" rel="stylesheet" type="text/css" media="screen"/>
		
		<title>Inscription</title>
	</header>
	
	<body>
		
		<?php 
		    if(isset($_SESSION['flash'])){ 
		        foreach($_SESSION['flash'] as $type => $message): ?>
				<div id="alert" class="alert alert-<?= $type; ?> infoMessage"><a class="close">X</span></a>
					<?= $message; ?>
				</div>	
		    
			<?php
			    endforeach;
			    unset($_SESSION['flash']);
			}
		?> 

		<div class="entete">
			<br>
			<h1>Adopte Une Culture</h1>

		</div>


		<div class="contaiper">
				
	        
	            
	            
		          <div class="formulaire">
		            <h1 class="index-h1">Inscription</h1>
		            
		            <br/>
	                
	                <form method="post" action="inscription.php">
	                    
                        <label>* Pseudo :</label>
                    	<br/>
						<?php
							if(isset($error_pseudo)){
								echo $error_pseudo."<br/>";
							}	
						?>
                    	<input class="input" type="text" name="Pseudo" placeholder="Pseudo" value="<?php if (isset($Pseudo)) echo $Pseudo; ?>" maxlength="20" required="required">	
						<br><br>
						<label>* Mail :</label>
						<br>
						<input class="input" type="email" name="Mail" placeholder="Votre mail" value="<?php if (isset($Mail)) echo $Mail; ?>" required="required">	
	
	<br><br>
	                    <label for="Password">* Mot de passe :</label>
	                    	
                    	<br/>
						<?php
							if(isset($error_password)){
								echo $error_password."<br/>";
							}	
						?>

                        <input class="input" type="password" name="Password" placeholder="Mot de passe" value="<?php if (isset($Password)) echo $Password; ?>" required="required">
	
	<br><br>
	                    <label>* Confirmez votre mot de passe :</label>
                    	</br>
						<?php
							if(isset($error_passwordConf)){
								echo $error_passwordConf."<br/>";
							}	
						?>

                        <input class="input" type="password" name="PasswordConfirmation" placeholder="Confirmation du mot de passe" required="required">
	                        <br><br>
								<button id="btn-inscr" type="submit">S'inscrire</button>
	                        
	                                                        
	                   
	
	                </form>
	                </div>
	                
	                <br/>
	                <br/>
	                <a href="../index.php">Retour à l'accueil</a>
	                <br>
	                <span>* : Information obligatoire;.</span>
	                
	           
	
	            
	        
        </div>
		
	</body>
</html>
