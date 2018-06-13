<?php
session_start();
$titre="Profil";

include("../includes/includes.php");
include("../includes/navbar.php");

/*$iduser = $DB->query('SELECT id_user FROM f_topics');
$iduser = $iduser->fetchAll();*/
$contenuT =$DB->query('SELECT * FROM f_topics INNER JOIN user ON f_topics.id_user = user.pseudo /*WHERE id_user=\'.$iduser*/');
$contenuT = $contenuT->fetchAll();

if(!empty($_POST)){
        extract($_POST);
        $valid = true;
        $num = $_GET['id_topic'];
    

if (isset($_POST['envoie-reponse'])) {
    $contenu = htmlentities(trim($contenu));

        if (empty ($contenu)) {
            $valid = false;
            $er_contenu = ('Remplisser le contenu');

                    }

    if ($valid) {
        date_default_timezone_set('Europe/Paris');
                $date_creation = date('Y-m-d H:i:s');
         $DB->insert("INSERT INTO f_reponse (id_top, id_posteur, contenu, date_creation) VALUES (?,?,?,?)",
            array($num, $_SESSION['pseudo'], $contenu, $date_creation));

    }

}
}
$id = $_GET['id_topic'];
$com = $DB->query("SELECT * FROM f_reponse INNER JOIN user ON f_reponse.id_posteur = user.pseudo WHERE id_top =" .$id);
$com = $com->fetchAll();

// $post = $DB->query("SELECT * FROM user INNER JOIN f_reponse ON user.pseudo = f_reponse.id_posteur");
// $post = $post->fetchAll();

// foreach ($post as $p) {
// 	# code...
// }
// var_dump($post);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../index.css">
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
<?php
   foreach($contenuT as $ct){};
   ?>
   <div class="top"> 
  <div><p>Contenu : <br> <?php echo $_GET['contenu'] ; ?> !</p></div>
  


  </div>


<?php 
foreach ($com as $c) {

	?>


  <div class="rep">
  	<div class="left"> Auteur : <br><?= $c['id_posteur'] ?></div>
  	<div class="right"> Reponse : <?= $c['contenu'] ?></div>
  	 
  </div>
<?php } ?>

<!-- FORMULAIRE DE REPONSE -->
<div id="fc">
   <form method="post">
        <?php
            if (isset($er_contenu)){

        ?>
            <div class="er-msg"><?= $er_contenu ?></div>
        <?php   
            }
        ?>
        <label for="contenu">Votre message : </label>
         <textarea class="noresize"name="contenu" rows="5" cols="70"><?php if(isset($contenu)){ echo $contenu; }?></textarea>
<br>
        <input class="btn_mp btn btn-primary btn-sm" type="submit" value="Envoyer" name="envoie-reponse">

     </form>
     </div>
</body>
</html>
