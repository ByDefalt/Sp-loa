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
   <title>PAD</title>
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
            <div class="logo"><a href="index.php" style=" color:#fff;">
                  <h1 style="font-size:2em;">Spéloa
               </a></h1>
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
                  <li>Pad</li>
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
               if (isset($_GET['code']) && strlen($_GET['code']) == 15) { // verifie que le code existe et qu'il est de longeur 15
                  $requetetoutpaddonnees = "SELECT pad_code,pad_id,pad_intitule,atl_intitule,atl_numero FROM t_pad_pad
               LEFT JOIN t_atelier_atl USING(pad_id)
               LEFT JOIN t_ressource_res USING(atl_numero)
               WHERE pad_code='" . $_GET['code'] . "'
               GROUP BY atl_intitule;"; // requete donnant le code du pad, son nom,le nom des atelier,leur numéros regrouper par nom d'atelier
                  $resulttoutpaddonnees = $mysqli->query($requetetoutpaddonnees); // execution de la requete
                  if ($resulttoutpaddonnees == false) { // erreur requete
                     echo "Error: La requête a echoué \n";
                     echo "Errno: " . $mysqli->errno . "\n";
                     echo "Error: " . $mysqli->error . "\n";
                  }
               ?>
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th scope="col">Nom du pad</th>
                           <th scope="col">Pseudo Animateur</th>
                           <th scope="col">Nom Atelier</th>
                           <th scope="col">Ressource</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        while ($resulttoutpaddonneestab = $resulttoutpaddonnees->fetch_assoc()) { // crée le tableaux associatif du résultat de la requete
                           $requeteanimpad = "SELECT cpt_pseudo FROM t_animation_ani
                                           WHERE pad_id='" . $resulttoutpaddonneestab['pad_id'] . "';"; // requete donnant le(s) pseudo(s) du pad
                           $resultanipad = $mysqli->query($requeteanimpad);// execution de la requete
                           if ($resultanipad == false) { // verification erreur
                              echo "Error: La requête a echoué \n";
                              echo "Errno: " . $mysqli->errno . "\n";
                              echo "Error: " . $mysqli->error . "\n";
                           }
                           $requeteresatl = "SELECT res_chemin_acces,res_titre FROM t_ressource_res
                                           WHERE atl_numero='" . $resulttoutpaddonneestab['atl_numero'] . "';";// requete donnant le titre et le chemin de la ressource
                           $resultresatl = $mysqli->query($requeteresatl);// execution de la requete
                           if ($resultresatl == false) { // verification erreur
                              echo "Error: La requête a echoué \n";
                              echo "Errno: " . $mysqli->errno . "\n";
                              echo "Error: " . $mysqli->error . "\n";
                           }
                        ?>
                           <tr>
                              <td><?php echo $resulttoutpaddonneestab['pad_intitule'] ?></td> <!-- affiche le titre du pad -->
                              <td><?php if ($resultanipad->num_rows == 0) { // verifier si la requete $resultanipad à 0 ligne donc pas d'animateur
                                       echo "Pas d'Animateur";
                                    } else { // sinon
                                       while ($resultanipadtab = $resultanipad->fetch_assoc()) { // crée le tableaux associatif du résultat de la requete
                                          echo $resultanipadtab['cpt_pseudo'] . "<br>"; // affiche le(s) pseudo(s) des animateur
                                       }
                                    } ?></td>
                              <td><a href=<?php echo "atelier.php?code=" . $resulttoutpaddonneestab['pad_code'] . "&id=" . $resulttoutpaddonneestab['atl_numero']  ?>><?php echo $resulttoutpaddonneestab['atl_intitule'] ?></a></td> <!-- crée le lien pour aller sur la page atelier en fonction de l'atelier de du pad et affiche le nom du pad-->
                              <td><?php if ($resultresatl->num_rows == 0) { // verifier si la requete $resultresatl à 0 ligne donc pas de ressource
                                       echo "Pas de ressource";
                                    } else { // sinon
                                       while ($resultresatltab = $resultresatl->fetch_assoc()) { // crée le tableaux associatif du résultat de la requete
                                    ?><a href=<?php if (!filter_var($resultresatltab['res_chemin_acces'], FILTER_VALIDATE_URL) == false) { // permet de verifiet si le chemin est un lien ou non
                                                   echo $resultresatltab['res_chemin_acces']; // si cest un lien alors ont met le lien dans le href
                                                } else { //sinon
                                                   echo "." . $resultresatltab['res_chemin_acces']; // . puis chemin acces
                                                }
                                                ?>>
                                          <?php echo $resultresatltab['res_titre'] ?><!-- affiche le nom de la ressource -->
                                       </a>
                                 <?php
                                          echo "<br>";
                                       }
                                    }
                                 ?>
                              </td>
                           </tr>
                        <?php
                        }
                        ?>
                     </tbody>
                  </table>

               <?php
               } else {
                  echo "Pas de code";
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