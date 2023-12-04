<?php
session_start(); // demare la session


if (!isset($_SESSION['login'])) { // verifie si la variable existe
   header("Location:session.php");
   exit();
}

$mysqli = new mysqli('localhost', 'zrousvaro', '2phkvttc', 'zfl2-zrousvaro_1'); // connection base de données

if ($mysqli->connect_errno) { // verification erreur
   echo "Error: Problème de connexion à la BDD \n";
   echo "Errno: " . $mysqli->connect_errno . "\n";
   echo "Error: " . $mysqli->connect_error . "\n";
}
if (!$mysqli->set_charset("utf8")) { // verification erreur
   printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
}


function error_requete($requete) // fonction verification erreur
{
   global $mysqli;
   if ($requete == false) {
      echo "Error: La requête a echoué \n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
   }
}

$requete_tout_config = "SELECT * FROM t_configuration_cfg;"; // recupère toute les informations de la table configuration
$result_tout_config = $mysqli->query($requete_tout_config); // execute la requete
error_requete($result_tout_config); // verification erreur
$config = $result_tout_config->fetch_assoc(); // crée le tableaux associatif du résultat de la requete

$requete_compte_profil = "SELECT * FROM t_profil_pfl
                        JOIN t_compte_cpt USING(cpt_pseudo);"; // recupère toute les informations de la table profil et compte
$result_compte_profil = $mysqli->query($requete_compte_profil); // execute la requete
error_requete($result_compte_profil); // verification erreur

$compteur = 0;

$requete_info_profil = "SELECT pfl_nom,pfl_prenom FROM t_profil_pfl
                      JOIN t_compte_cpt USING(cpt_pseudo)
                      WHERE cpt_pseudo='" . $_SESSION["login"] . "';"; // recupère le nom et prenom en fonction du login

$result_info_profil = $mysqli->query($requete_info_profil); // execute la requete
error_requete($result_info_profil); // verification erreur
$result_info_profil_tab = $result_info_profil->fetch_assoc(); // crée le tableaux associatif du résultat de la requete

?>

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
   <title>Admin Home</title>
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
            <div class="logo"><a href="index.php" style=" color:#fff;">
                  <h1 style="font-size:2em;color:#fff;">Spéloa</h1>
            </div>
            <div class="menu_text">
               <div class="togle_">
                  <div class="menu_main">
                     <ul>
                        <li><a href="logout.php">Logout</a></li>
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
                     <a href="logout.php">Logout</a>
                     <a>-----------Admin------------</a>
                     <a href="admin_accueil.php">Home</a>
                     <a href="admin_ateliers.php">Atelier</a>
                  </div>
               </div>
               <span class="navbar-toggler-icon"></span>
               <span onclick="openNav()"><img src="data/toogle-icon.png" class="toggle_menu"></span>
               <span onclick="openNav()"><img src="data/toogle-icon1.png" class="toggle_menu_1"></span>

            </div>
         </div>
      </div>
      <!-- banner section start -->
      <div class="container">
         <div class="about_taital_main">
            <h2 class="about_tag">
               <?php echo ($config['cfg_nom']) ?><!-- affiche le nom de l'association-->
            </h2>
            <div class='about_menu' style='margin-bottom:1em;'>
               <ul>
                  <li>
                     <?php echo $config['cfg_mot_du_president'] ?><!-- affiche le mot du président de l'association-->
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
      <h1 class='news_taital'>ESPACE ADMINISTRATION</h1>
      <h3 style="text-align: center;">
         <?php echo $_SESSION['login'] . "<br><br>" . $_SESSION['role'] ?><!-- affiche le pseudo et le role-->
      </h3>
      <div class='news_section_2 layout_padding'>
         <div class="container">
            <div class="row">
               <?php if ($_SESSION['role'] == 'R') { ?><!-- si responsable alors-->
                  <div class='box_main' style="width:auto;">
                     <h3 style="text-align: center;">
                        <?php echo "Nombre de ligne : " . ($result_compte_profil->num_rows) ?><!-- afficher le nombre de profil-->
                     </h3>
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th scope="col">Nom</th>
                              <th scope="col">Prenom</th>
                              <th scope="col">Pseudo</th>
                              <th scope="col">Role</th>
                              <th scope="col">Validité</th>
                              <th scope="col">Date</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           while ($result_compte_profil_tab = $result_compte_profil->fetch_assoc()) { ?><!-- crée le tableaux associatif du résultat de la requete pour chaque ligne -->
                              <form action="comptes_action.php" method="post" id="validite<?php echo $compteur; ?>"><!-- crée un formulaire à id variable afin de faire de chaque ligne du tableaux un formulaire -->
                                 <input type="hidden" name="cpt_pseudo_V" value="<?php echo $result_compte_profil_tab["cpt_pseudo"] ?>"><!-- input indden pour stocker l'information sans la voir -->
                                 <tr id="<?php echo $compteur ?>"><!-- id variable afin de preremplir le formulaire -->
                                    <td><?php echo $result_compte_profil_tab["pfl_nom"] ?></td><!--affichage des informations-->
                                    <td><?php echo $result_compte_profil_tab["pfl_prenom"] ?></td><!--affichage des informations-->
                                    <td><?php echo $result_compte_profil_tab["cpt_pseudo"] ?></td><!--affichage des informations-->
                                    <td><?php echo $result_compte_profil_tab["pfl_role"] ?></td><!--affichage des informations-->
                                    <td style="text-align:center;font-weight: bold;">
                                       <a onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='#666666'" onclick="validites(<?php echo $compteur ?>)"><?php echo $result_compte_profil_tab["pfl_validite"] ?></a><!-- Permet de crée un bouton pour modifier la validité-->
                                    </td>
                                    <td><?php echo $result_compte_profil_tab["pfl_date"] ?></td><!-- affichage de la date -->
                                    <td><a onclick="modifier(<?php echo $compteur ?>)">Modifier</a></td><!-- bouton modifier afin de modifier les profil-->
                                 </tr>
                                 <input style="display:none;" type="submit">
                              </form>
                           <?php
                              $compteur++; // incrémente le compteur
                           } ?>
                        </tbody>
                     </table>
                  </div>
                  <div class="box_main" style="display:none;" id="modifcompte">
                     <h2 style="text-align:center;">Modifier</h2>
                     <form action="comptes_action.php" method="post" id="modifcompteform"><!-- formulaire qui ce préremplit pour modifier les comptes-->
                        <div class="form-group">
                           <label>Nom :</label>
                           <input type="nom" class="form-control" name="pfl_nom_R" placeholder="Nom" required maxlength="60" value="">
                        </div>
                        <div class="form-group">
                           <label>Prénom :</label>
                           <input type="prenom" class="form-control" name="pfl_prenom_R" placeholder="Prénom" required maxlength="60" value="">
                        </div>
                        <div class="form-group">
                           <label>Email :</label>
                           <input disabled type="email" class="form-control" name="" placeholder="Email" required maxlength="60" value="">
                           <input type="hidden" class="form-control" name="cpt_pseudo_R" required maxlength="60">
                        </div>
                        <div class="form-group">
                           <label>Role :</label>
                           <select class="custom-select" name="pfl_role_R">
                              <option value="A">A</option>
                              <option value="R">R</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Validiter :</label>
                           <select class="custom-select" name="plf_validite_R">
                              <option value="A">A</option>
                              <option value="D">D</option>
                           </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom:1em; margin-left: 1em;">Submit</button>
                     </form>
                  </div>
            </div>
                  <div class='box_main'>
                     <h2 style="text-align:center;">Activer/Desactiver</h2>
                     <form action="comptes_action.php" method="post" style="padding-top: 1em;"><!-- formulaire pour modifier la validité-->
                        <div class="form-group">
                           <select class="custom-select" name="cpt_pseudo_V">
                              <option selected>Select menu</option>
                              <?php
                              $result_compte_profil = $mysqli->query($requete_compte_profil); // execute la requette
                              error_requete($result_compte_profil); // verifie erreur
                              while ($result_compte_profil_tab = $result_compte_profil->fetch_assoc()) { ?><!--crée le tableaux associatif du résultat de la requete pour chaque ligne-->
                                 <option value="<?php echo $result_compte_profil_tab['cpt_pseudo'] ?>"><?php echo $result_compte_profil_tab['cpt_pseudo'] ?></option><!--crée un choix avec la valeur des pseudo-->
                              <?php } ?>
                           </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom:1em; margin-left: 1em;">Submit</button>
                     </form>
                  </div>
               <?php } ?>
               <div class='box_main' style="width:auto;">
                  <h2 style="text-align:center;">Modifier</h2>
                  <form action="comptes_action.php" method="post" class="modifcompteforms"><!-- formulaire pour modifier le compte préremplit avec les information récupérer grace au login-->
                     <div class="form-group">
                        <label>Nom :</label>
                        <input type="nom" class="form-control" name="pfl_nom_A" placeholder="Nom" required maxlength="60" value="<?php echo $result_info_profil_tab['pfl_nom'] ?>">
                     </div>
                     <div class="form-group">
                        <label>Prénom :</label>
                        <input type="prenom" class="form-control" name="pfl_prenom_A" placeholder="Prénom" required maxlength="60" value="<?php echo $result_info_profil_tab['pfl_prenom'] ?>">
                     </div>
                     <div class="form-group">
                        <label>Email :</label>
                        <input disabled type="email" class="form-control" name="cpt_pseudo_A" placeholder="Email" required maxlength="60" value="<?php echo $_SESSION['login'] ?>">
                     </div>
                     <input type="hidden" class="form-control" name="cpt_pseudo_A" placeholder="Email" required maxlength="60" value="<?php echo $_SESSION['login'] ?>">
                     <div class="form-group">
                        <label>Password :</label>
                        <input type="password" class="form-control" name="cpt_mot_de_passe_A" placeholder="Password" required value="">
                     </div>
                     <button type="submit" class="btn btn-primary" style="margin-bottom:1em; margin-left: 1em;" name="modifA">Submit</button>
                  </form>
               </div>
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

      function validites(i) {
         var validite = document.getElementById("validite" + i);
         validite.submit(validite);
      }

      function modifier(i) { // permet de préremplir le formulaire grace a l'id variable
         var box = document.getElementById('modifcompte');
         box.style.display = "";
         var formtab = document.getElementById(i);
         var formresult = document.getElementById("modifcompteform");
         var tab = formtab.children;
         formresult[0].value = tab[0].innerHTML;
         formresult[1].value = tab[1].innerHTML;
         formresult[2].value = tab[2].innerHTML;
         formresult[3].value = tab[2].innerHTML;
         console.log(tab[4].children[0].innerHTML);
         formresult[4][1].selected = (tab[3].innerHTML == "R") ? true : false;
         formresult[5][1].selected = (tab[4].children[0].innerHTML == "D") ? true : false;

      }
   </script>
</body>

</html>
<?php $mysqli->close(); ?>