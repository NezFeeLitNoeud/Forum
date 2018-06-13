<?php
session_start();

include ('../includes/navbar.php');

include ('../includes/includes.php');

$bdd = new PDO('mysql:host=localhost;dbname=fofo', 'root', 'root');
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
$msg = $bdd->prepare('SELECT * FROM f_mp INNER JOIN user ON f_mp.mp_destinataire = user.id');
$msg->execute(array($_SESSION['pseudo']));
// $msg_nbr = $msg->rowCount();
foreach ($msg as $m) {
   # code...
    }

    
     $p_exp = $bdd->prepare('SELECT * FROM user INNER JOIN f_mp ON user.pseudo = f_mp.mp_expediteur');
      $p_exp->execute(array($m['pseudo']));
      $p_exp = $p_exp->fetch();

      $p1 = $m ['pseudo']; // Destinataire
      $p2 = $_SESSION['pseudo']; // Personne connecter
?>

<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="../index.css">
   <title>Boîte de réception</title>
   <meta charset="utf-8" />
</head>


<body  class="fontrecep">


   <h1 id="h2">Boite de réception : </h1>

<div>
<div class="reception">
  <?php while ($p1===$p2) {
  
echo "<div class='colonne_mp'><div id='auteur_mp'>De : " . $m['mp_expediteur']. "</div></div>";
echo "<div class='ligne_mp'><div id='titre_mp'>Titre : " . $m['mp_contenu']. "</div>";
echo "<div id='contenu_mp'>Contenu : <br>" . $m['mp_titre']. "</div></div>";
break;
   } 
  ?>
  <?php while ($p1!=$p2) {
  
echo " Vous n'avez pas de message ".$_SESSION['pseudo']. "<br></div>";
echo '<a href="nouveau_mp.php"><button type="button" class="btn_mp btn btn-primary btn-sm">Nouveau</button></a>';
break;
   } 
  ?>
  </div>
  <br>
  <a href="nouveau_mp.php"><button type="button" class="btn_mp btn btn-primary btn-sm">Répondre</button></a></div>
</div>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</body>
</html>
<?php } ?> 