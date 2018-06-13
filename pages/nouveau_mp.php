<?php
session_start();
include ('../includes/includes.php');
include ('../includes/navbar.php');


$bdd = new PDO('mysql:host=localhost;dbname=fofo', 'root', 'root');
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
   if(isset($_POST['envoi_message'])) {
      if(isset($_POST['destinataire'],$_POST['message'],$_POST['titre']) AND !empty($_POST['destinataire']) AND !empty($_POST['message']) AND !empty($_POST['titre'])) {
         $destinataire = htmlspecialchars($_POST['destinataire']);
         $message = htmlspecialchars($_POST['message']);
         $titre = htmlspecialchars($_POST['titre']);
         $id_destinataire = $bdd->prepare('SELECT id FROM user WHERE pseudo = ?');
         $id_destinataire->execute(array($destinataire));
         $dest_exist = $id_destinataire->rowCount();
         if($dest_exist == 1) {
            $id_destinataire = $id_destinataire->fetch();
            $id_destinataire = $id_destinataire['id'];
            $ins = $bdd->prepare('INSERT INTO f_mp(mp_expediteur,mp_destinataire,mp_titre,mp_contenu) VALUES (?,?,?,?)');
            $ins->execute(array($_SESSION['pseudo'],$id_destinataire,$message, $titre));
            $error = "Votre message a bien été envoyé !";
         } else {
            $error = "Cet utilisateur n'existe pas...";
         }
      } else {
         $error = "Veuillez compléter tous les champs";
      }
   }
   $destinataires = $bdd->query('SELECT pseudo FROM user ORDER BY pseudo');
   ?>
   <!DOCTYPE html>
   <html>
   <head>
      <link rel="stylesheet" href="../index.css">
      <title>Envoi de message</title>
      <meta charset="utf-8" />
   </head>
   <body>
      <div class="messpriv">
         <form method="POST">
            <label>Destinataire :</label>
            <select name="destinataire" id="pruet">
               <?php while($d = $destinataires->fetch()) { ?>
               <option><?= $d['pseudo'] ?></option>
               <?php } ?>
            </select>
            <br /><br />
            <textarea placeholder='Votre titre' class="textamp" name='titre' minlength="1" maxlength="100" rows="1" cols="40"></textarea>
            <br /><br />
            <textarea placeholder="Votre message" class="textamp" name="message" rows="7" cols="40"></textarea>
            <br /><br />
            <input class="btn_mp btn btn-primary btn-sm" type="submit" value="Envoyer" name="envoi_message"></button>
            <br /><br />
            <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } ?>
         </form>
      <br />
      <a id="ahref" href="reception_mp.php">Boîte de réception</a>
      </div>
   </body>
   </html>
<?php
}
?>