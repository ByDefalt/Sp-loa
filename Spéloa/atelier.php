<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Atelier</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <!-- fevicon -->
   <!-- <link rel="icon" href="data/fevicon.png" type="image/gif" /> -->
   <!-- Scrollbar Custom CSS -->
   <!-- <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css"> -->
   <!-- style css -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- copyright section end -->
   <!-- Javascript files-->
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <!-- sidebar -->
   <!-- <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> -->
   <!-- <script src="js/custom.js"></script> -->
   <!-- javascript -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>
   <!--header section start -->
   <div class="header_section header_bg">
      <div class="container-fluid">
         <div class="main">
         <div class="logo">
               <a href="index.php" style=" color:#fff;">
                  <h1 style="font-size:2em;color:#fff; ">Spéloa</h1>
               </a>
            </div>
            <div class="menu_text">
               <ul>
                  <div class="togle_">
                     <div class="menu_main">
                        <ul>
                           <li><a href="session.php">Login</a></li>
                           <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <div id="myNav" class="overlay">
                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <div class="overlay-content">
                        <a href="index.php">Home</a>
                        <a href="inscription.php">Inscription</a>
                        <a href="animation.php">Animation</a>
                        <a href="session.php">Login</a>
                     </div>
                  </div>
                  <span class="navbar-toggler-icon"></span>
                  <span onclick="openNav()"><img src="data/toogle-icon.png" class="toggle_menu"></span>
                  <span onclick="openNav()"><img src="data/toogle-icon1.png" class="toggle_menu_1"></span>
               </ul>
            </div>
         </div>
      </div>
      <!-- banner section start -->
      <div class="container">
         <div class="about_taital_main">
            <h2 class="about_tag">
               <?php
               $mysqli = new mysqli('localhost', 'zrousvaro', '2phkvttc', 'zfl2-zrousvaro_1'); // connection base de données
               if ($mysqli->connect_errno) { // verification erreur
                  echo "Error: Problème de connexion à la BDD \n";
                  echo "Errno: " . $mysqli->connect_errno . "\n";
                  echo "Error: " . $mysqli->connect_error . "\n";
               }
               if (!$mysqli->set_charset("utf8")) { // verification erreur
                  printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
               }
               $requetetoutconfig = "SELECT * FROM t_configuration_cfg;"; // recupère toute les informations de la table configuration
               $resulttoutconfig = $mysqli->query($requetetoutconfig); // execute la requete
               if ($resulttoutconfig == false) { // verification erreur
                  echo "Error: La requête a echoué \n";
                  echo "Errno: " . $mysqli->errno . "\n";
                  echo "Error: " . $mysqli->error . "\n";
               } else {
                  $config = $resulttoutconfig->fetch_assoc(); // crée le tableaux associatif du résultat de la requete
                  echo ($config['cfg_nom']); // affiche le nom de l'association
               }
               ?>
            </h2>
            <div class='about_menu' style='margin-bottom:1em;'>
               <ul>
                  <li>
                     <?php echo $config['cfg_mot_du_president'] ?> <!-- affiche le nom de l'association -->
                  </li>
               </ul>
            </div>
            <div class='about_menu'>
               <ul>
                  <li><a href='index.php'>Home</a></li>
                  <li>Atelier</li>
               </ul>
            </div>
         </div>
      </div>
      <!-- banner section end -->
   </div>
   <!-- header section end -->
   <!-- protect section start -->
   <div class="protect_section layout_padding">
      <div class="container">
         <div class='news_section_2 layout_padding'>
            <div class='box_main'>
               <?php
               if (isset($_GET['id']) && is_int(intval($_GET['id'])) && isset($_GET['code']) && strlen($_GET['code']) == 15) { // verifie si le code et l'id sont valide
                  $requetetoutresatl = "SELECT atl_numero,res_chemin_acces,res_type_ressource FROM t_atelier_atl
               JOIN t_ressource_res USING(atl_numero)
               JOIN t_pad_pad USING(pad_id)
               WHERE atl_numero='" . $_GET['id'] . "'
               AND pad_code='" . $_GET['code'] . "';"; // requete donnant les information de ressource en fonction du code du pad et de l'id de l'atelier
                  $resulttoutresatl = $mysqli->query($requetetoutresatl);// execution de la requete
                  if ($resulttoutresatl == false) { // verification erreur
                     echo "Error: La requête a echoué \n";
                     echo "Errno: " . $mysqli->errno . "\n";
                     echo "Error: " . $mysqli->error . "\n";
                  }
                  $requeteinfopadatl = "SELECT pad_intitule,atl_intitule,atl_date,atl_texte FROM t_atelier_atl
                                JOIN t_pad_pad USING(pad_id)
                                WHERE atl_numero='" . $_GET['id'] . "'
                                AND pad_code='" . $_GET['code'] . "';"; // requete donnant les information de atelier en fonction du code et de l'id
                  $resultinfopadatl = $mysqli->query($requeteinfopadatl);// execution de la requete
                  if ($resultinfopadatl == false) {// verification erreur
                     echo "Error: La requête a echoué \n";
                     echo "Errno: " . $mysqli->errno . "\n";
                     echo "Error: " . $mysqli->error . "\n";
                  }
                  $resultinfopadatltab = $resultinfopadatl->fetch_assoc() // crée le tableaux associatif du résultat de la requete
               ?>
                  <div class='container' style="padding-top:1em;">
                     <div class='box_main'>
                        <center>
                           <h2><?php echo $resultinfopadatltab['pad_intitule'] ?></h2> <!--affiche le titre du pad-->
                        </center>
                        <center>
                           <h5><?php echo $resultinfopadatltab['atl_intitule'] ?></h5><!--affiche le titre de l'atelier-->
                        </center>
                        <center>
                           <p><?php echo $resultinfopadatltab['atl_texte'] ?></p><!--affiche le texte de l'atelier-->
                        </center>
                        <div Align=RIGHT>
                           <p><?php echo $resultinfopadatltab['atl_date'] ?></p><!--affiche la date de l'atelier-->
                        </div>
                     </div>
                  </div>
                  <?php
                  while ($resulttoutresatltab = $resulttoutresatl->fetch_assoc()) { // crée le tableaux associatif du résultat de la requete

                     if ($resulttoutresatltab['res_type_ressource'] == 0) { // verifier si les types des ressource et choisis les bonne balise html en fonction
                  ?><img style='width:100%; padding-bottom:1em;' src=<?php echo "." . $resulttoutresatltab['res_chemin_acces'] ?>>
                     <?php
                     } else if ($resulttoutresatltab['res_type_ressource'] == 2) {
                     ?><a style="padding-bottom:1em;" href=<?php echo $resulttoutresatltab['res_chemin_acces'] ?>>
                           <?php echo $resulttoutresatltab['res_chemin_acces'] ?></a>
                     <?php
                     } else if ($resulttoutresatltab['res_type_ressource'] == 1) {
                     ?><iframe src=<?php echo "." . $resulttoutresatltab['res_chemin_acces'] ?> style="width:100%; padding-bottom:1em; height:500px;">
                        </iframe>
                        <?php
                     } else if ($resulttoutresatltab['res_type_ressource'] == 3) {
                        ?><video width="100%" controls>
                              <source src=<?php echo $resulttoutresatltab['res_chemin_acces'] ?> type="video/mp4">
                              Votre navigateur ne supporte pas la balise video !
                           </video>
                  <?php
                     }
                     echo "<br>";
                  }
               } else {
                  echo "Pas d'id";
               }
                  ?>
            </div>
         </div>
      </div>
   </div>
   <!-- protect section end -->
   <!-- footer section start -->
   <div class="footer_section layout_padding">
      <div class="container">
         <div class="footer_section_2">
            <div class="row">
               <div class='col-lg-3 col-sm-6'>
                  <h2 class='useful_text'>Contact Us</h2>
                  <div class='location_text'>
                     <ul>
                        <li>
                           <i class='fa fa-map-marker' aria-hidden='true'></i>
                           <span class='padding_15'><?php echo $config['cfg_adress_postale'] ?></span><!-- affiche l'adresse de l'association-->
                        </li>
                        <li>
                           <i class='fa fa-phone' aria-hidden='true'></i>
                           <span class='padding_15'>Call +33 <?php echo $config['cfg_numero_telephone'] ?></span><!-- affiche le numero de telephone de l'association-->
                        </li>
                        <li>
                           <i class='fa fa-envelope' aria-hidden='true'></i>
                           <span class='padding_15'><?php echo $config['cfg_adresse_email'] ?></span><!-- affiche l'adresse email de l'association-->
                        </li>
                     </ul>
                  </div>
               </div>
               <?php $mysqli->close(); ?>
            </div>
         </div>
      </div>
   </div>
   <!-- footer section end -->
   <!-- copyright section start -->
   <div class="copyright_section">
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <p class="copyright_text">© 2020 All Rights Reserved</p>
            </div>
         </div>
      </div>
   </div>
   <!-- copyright section end -->
   <script>
      function openNav() {
         document.getElementById("myNav").style.width = "100%";
      }

      function closeNav() {
         document.getElementById("myNav").style.width = "0%";
      }
   </script>
</body>

</html>