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
   <title>Home</title>
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
   <div class="header_section">
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
                        <a href="animation.php">Animation</a>
                        <a href="inscription.php">Inscription</a>
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
         </div>
      </div>
      <!-- banner section end -->
   </div>
   <!-- header section end -->

   <!-- news section start -->
   <div class="news_section layout_padding">
      <div id="main_slider" class="carousel slide" data-ride="carousel">
         <h1 class='news_taital'>Latest News</h1>
         <div class='news_section_2 layout_padding'>
            <div class='box_main'>
               <table class="table table-striped"><!-- table des news -->
                  <thead>
                     <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Texte</th>
                        <th scope="col">Date de Publication</th>
                        <th scope="col">Auteur</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $requetetoutnews = "SELECT * FROM t_news_new
                                          WHERE new_etat='P'
                                          ORDER BY new_datePublication DESC
                                          LIMIT 5;"; // les 5 news les plus recentes
                     $resulttoutnews = $mysqli->query($requetetoutnews);// execution de la requete
                     if ($resulttoutnews == false) { // verification erreur
                        echo "Error: La requête a echoué \n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                     } else {
                        while ($actu = $resulttoutnews->fetch_assoc()) {  // crée le tableaux associatif du résultat de la requete pour chaque ligne
                     ?>
                           <tr>
                              <td><?php echo $actu['new_titre'] ?></td><!-- affiche le titre -->
                              <td><?php echo $actu['new_texte'] ?></td><!-- affiche le texte -->
                              <td><?php echo $actu['new_datePublication'] ?></td><!-- affiche la date -->
                              <td><?php echo $actu['cpt_pseudo'] ?></td><!-- affiche le pseudo -->
                           </tr>
                     <?php
                        }
                     }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <!-- news section end -->
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