<?php
session_start();
include_once('includes.php');
header( "refresh:3;url=../index.php" ); 	
?>

<!DOCTYPE html>
<html lang="fr">
	<header>
		<link href="../index.css" rel="stylesheet" />
		<title>Redirect</title>
	</header>
	<body>
			<div id="topit"><br>
			<h1>Adopte Une Culture</h1>
		</div>
		<div id="contenu32">
		
			<?php 
			    if(isset($_SESSION['flash'])){ 
			        foreach($_SESSION['flash'] as $type => $message): ?>
					<div id="alert" class="alert alert-<?= $type; ?> infoMessage"><a class="close"></span></a>
						<?= $message; ?>
					</div>	
			    
				<?php
				    endforeach;
				    unset($_SESSION['flash']);
				}
			?> 

			<?php echo 'Vous allez être redirigé dans 3s. ';
					echo 'Si ce n\'est pas le cas, cliquer <a href="index.php">ici</a>.'; 
			?>
		</div>
	</body>
</html>