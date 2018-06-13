<?php
session_start();
include ('../includes/navbar.php');

?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../index.css">
   </head>
   <body>
      <div class="no_profil">
         <h2>Bonjour <?php echo $_SESSION['pseudo'];?></h2><br>
         <p>Les modifications du profil ne sont pas encore disponible malheureusement</p>
         <p>Par chance nos équipes techniques travaillent dessus ! Tu peux suivre leur avancées :</p>

         <div class="progress">
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
</div>
<br>
         <p><a href="accueil.php">Retour à l'accueil.</a> </p>
         <p><a href="voirprofil.php">Retourner sur votre Profil.</a></p>

         
      </div>

      </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
   </body>
</html>
<?php   
