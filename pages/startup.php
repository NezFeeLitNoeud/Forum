<?php
session_start();
$titre="jv";
include("../includes/includes.php");
include("../includes/navbar.php");


$req = $DB->query("SELECT * FROM f_categories WHERE id = 3");
$req = $req->fetchAll();
foreach($req as $r){};



$topicsParPage = 7;
$topicsTotalesReq = $DB->query('SELECT id_topic FROM f_topics');
$topicsTotales = $topicsTotalesReq->rowCount();
$pagesTotales = ceil($topicsTotales/$topicsParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
   $_GET['page'] = intval($_GET['page']);
   $pageCourante = $_GET['page'];
} else {
   $pageCourante = 1;
}
$depart = ($pageCourante-1)*$topicsParPage;

$topics = $DB->query('SELECT * FROM f_topics WHERE id_cat = 3 ORDER BY date_creation DESC LIMIT '.$depart.','.$topicsParPage);
$topics = $topics->fetchAll();
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../index.css">
   </head>
   <body id="gameimage">

<!-- TOP PAGE -->
<div class="en-teteacceuil">
          <h1 class=""><?= $r['nom']?> </h1>       
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
            
        <!--  MID PAGE -->
     

<div class="container">
   <a id="ahreff" href="accueil.php">Accueil</a> > Catégorie : Start-up
   <div class="row"> 

<div class="table-responsive" style="margin-top: 0px">
                <table class="table table-striped">
                    <tr>
                        <th id="tabcat">Sujet</th>
                        <th id="tabmess">Auteur</th>
                        
                    </tr>
                <?php
                    foreach($topics as $top){ 
                    ?>  
                        <tr>
                            <td>
                                
                                <a id="ahref" href="afficher_topic.php?id_topic=<?php echo $top['id_topic']; ?>&contenu=<?php echo $top['contenu']; ?>&sujet=<?php echo $top['sujet']; ?>"><?= $top['sujet'] ?></a>
                                 
                            </td>
                                <td>
                                    Par : <?= $top['id_user'] ?> <br> le <?= $top['date_creation'] ?>
                                </td>
                           
                        </tr>   
                    <?php
                    
                    }
                ?>
                </table> 
            </div>
        </div>







<?php 

      for($i=1;$i<=$pagesTotales;$i++) {
         if($i == $pageCourante) {
            echo $i.' ';
         } else {
            echo '<a href="jv.php?page='.$i.'">'.$i.'</a> ';
         }
      }
      ?>
   
   </body>
</html>