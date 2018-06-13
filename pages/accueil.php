<?php
session_start();
include_once('../includes/includes.php');
include ('../includes/navbar.php');
 $req = $DB->query("SELECT * FROM f_categories ");
   $req = $req->fetchAll();


    if (!isset($_SESSION['id'])){
        header('Location: ../index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../index.css">
		<title>Accueil</title>
	</head>
	
	<body>
		
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
	        <div class="en-teteacceuil">
		       	<h1 class="">Accueil</h1>	
			       	<p>Bonjour <?php 
				    	if(!isset($_SESSION['id'])){
					       echo "vous n'êtes pas connecté !";
				    	}else{
					    	echo $_SESSION['pseudo'];
				       	}
				       	?>
					<br>
				       	Nous sommes le <?php $jour = date("d-m-Y");
							echo $jour; ?> 
				    </p>
        	</div>

        	

<!-- CONTENU DU FORUM -->			

		<div class="envase">
		 <div class="container">
            <div class="row">   

			<div class="table-responsive" style="margin-top: -42px">
                <table class="table table-striped tablacceuil">
                    <tr>
                        <th id="tabcat">Catégorie</th>
                    </tr>
                <?php
                    foreach($req as $r){ 
                    ?>  
                        <tr>
                            <td>
                                <a href="<?= $r['page'] ?>" id="ahref"><?= $r['nom'] ?></a>
                            </td>
                        </tr>   
                    <?php
                    }
                ?>
                </table>                    
            </div>
		</div>
</div>
	</body>
</html>