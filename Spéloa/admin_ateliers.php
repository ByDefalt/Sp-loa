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
$requete_tout_config = "SELECT * FROM t_configuration_cfg;";// recupère toute les informations de la table configuration
$result_tout_config = $mysqli->query($requete_tout_config);// execute la requete
error_requete($result_tout_config); // verification erreur
$config = $result_tout_config->fetch_assoc(); // crée le tableaux associatif du résultat de la requete
$requete_intitule_pad_atl = "SELECT pad_intitule,atl_intitule,atl_texte,atl_etat,atl_numero FROM t_pad_pad
                         LEFT JOIN t_atelier_atl USING(pad_id)
                         LEFT JOIN t_ressource_res USING(atl_numero)
                         GROUP BY atl_intitule
                         ORDER BY pad_intitule;"; // requete donnant les information des atelier et leur pad
$result_intitule_pad_atl = $mysqli->query($requete_intitule_pad_atl);// execute la requete
error_requete($result_intitule_pad_atl);// verification erreur
function requete_animateur_pad($pad_intitule) // fonction requete donnant le(s) pseudo(s) en fonction du pad
{
    $requete_animateur_pad = "SELECT cpt_pseudo FROM t_animation_ani
    JOIN t_pad_pad USING(pad_id)
    WHERE pad_intitule='" . $pad_intitule . "';";
    return $requete_animateur_pad;
}
function requete_ressources_atl($atl_intitule) // fonction requete donnant le(s) titre(s) des ressource en fonction de l'atelier
{
    $requete_ressources_atl = "SELECT res_titre FROM t_ressource_res
                                 JOIN t_atelier_atl USING(atl_numero)
                                 JOIN t_pad_pad USING(pad_id)
                                 WHERE atl_intitule='" . $atl_intitule . "';";
    return $requete_ressources_atl;
}
$requete_all_atelier = "SELECT atl_intitule FROM t_atelier_atl;"; // requete donnant les titres des l'ateliers
$result_all_atelier = $mysqli->query($requete_all_atelier);// execute la requete
error_requete($result_all_atelier);// verification erreur
$requete_all_pad = "SELECT pad_id,pad_intitule FROM t_pad_pad;";// tequete donnant l'id et le titre des pads
$result_all_pad = $mysqli->query($requete_all_pad);// execute la requete
error_requete($result_all_pad);// verification erreur
$compteur = 0; // variable qui sert de compteur
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
   <title>Admin Atelier</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
                        <h1 style="font-size:2em; color:#fff;">Spéloa</h1>
                </div>
                <div class="menu_text">
                    <ul>
                        <div class="togle_">
                            <div class="menu_main">
                                <ul>
                                    <li><a href="logout.php">Logout</a></li>
                                    <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="myNav" class="overlay">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <div class="overlay-content">
                                <a href="index.php">Home</a>
                                <a href="inscription.php">Inscription</a>
                                <a href="Animation.php">Animation</a>
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
                    </ul>
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
    <!-- protect section start -->
    <div class="protect_section layout_padding">
        <div class="container">
            <div class="row">
                <div class='box_main' style="width:auto;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom du pad</th>
                                <th scope="col">Pseudo Animateur</th>
                                <th scope="col">Nom Atelier</th>
                                <th scope="col">Ressource</th>
                                <th scope="col">Modifier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($result_intitule_pad_atl_tab = $result_intitule_pad_atl->fetch_assoc()) {// crée le tableaux associatif du résultat de la requete pour chaque ligne
                                $requete_animateur_pad = requete_animateur_pad($result_intitule_pad_atl_tab['pad_intitule']);// crée la requete en fonction du nom du pad
                                $requete_ressources_atl = requete_ressources_atl($result_intitule_pad_atl_tab['atl_intitule']);// crée la requete en fonction du nom de l'atelier
                                $result_animateur_pad = $mysqli->query($requete_animateur_pad);// execute la requete
                                error_requete($result_animateur_pad);// verification erreur
                                $result_ressources_atl = $mysqli->query($requete_ressources_atl);// execute la requete
                                error_requete($result_ressources_atl);// verification erreur
                            ?>
                                <tr id="<?php echo $compteur ?>"> <!--id variable pour permetre la recupération des informations -->
                                    <td><?php echo $result_intitule_pad_atl_tab['pad_intitule'] ?></td><!-- affiche les titre du pad -->
                                    <td><?php if ($result_animateur_pad->num_rows == 0) { //si 0 ligne a la requete alors 
                                            echo "Pas d'Animateur";
                                        } else {
                                            while ($result_animateur_pad_tab = $result_animateur_pad->fetch_assoc()) {// crée le tableaux associatif du résultat de la requete pour chaque ligne
                                                echo $result_animateur_pad_tab['cpt_pseudo'] . "<br>"; // affiche le(s) pseudo(s)
                                            }
                                        } ?></td>
                                    <td><?php if ($result_intitule_pad_atl_tab['atl_intitule'] == null) { //si pas de titre d'atelier alors
                                            echo "Pas d'atelier";
                                        } else { // sinon
                                            echo $result_intitule_pad_atl_tab['atl_intitule']; // afficher le titre de l'atelier
                                        } ?></td>
                                    <td><?php if ($result_ressources_atl->num_rows == 0) { // si le nombre de ligne est 0 alors
                                            echo "Pas de Ressource";
                                        } else { // sinon
                                            while ($result_ressources_atl_tab = $result_ressources_atl->fetch_assoc()) { // crée le tableaux associatif du résultat de la requete pour chaque ligne
                                                echo $result_ressources_atl_tab['res_titre'] . "<br>"; // affiche les titre des ressources
                                            }
                                        } ?></td>
                                    <td><a onclick="modifier_atl(<?php echo $compteur ?>)">Modifier</a></td><!--le bouton pour modifier les ateliers sur chaque lignes-->
                                    <td style="display:none"><?php echo $result_intitule_pad_atl_tab['atl_texte'] ?></td><!--ecrit les information en caché-->
                                    <td style="display:none"><?php echo $result_intitule_pad_atl_tab['atl_etat'] ?></td><!--ecrit les information en caché-->
                                    <td style="display:none"><?php echo $result_intitule_pad_atl_tab['atl_numero'] ?></td><!--ecrit les information en caché-->
                                </tr>
                            <?php $compteur++; // incrémente le compteur
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class='box_main'>
                    <h2 style="text-align:center;">Suprimer Atelier</h2>
                    <form action="admin_ateliers_action.php" method="post" style="padding-top: 1em;"><!-- formulaire de supression d'atelier -->
                        <div class="form-group">
                            <select class="custom-select" name="atl_intitule_supr"> <!--liste déroulante-->
                                <?php while ($result_all_atelier_tab = $result_all_atelier->fetch_assoc()) { ?> <!--crée le tableaux associatif du résultat de la requete pour chaque ligne-->
                                    <option value="<?php echo $result_all_atelier_tab['atl_intitule'] ?>"><?php echo $result_all_atelier_tab['atl_intitule'] ?></option><!--crée un choix avec la valeur des noms des ateliers-->
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom:1em; margin-left: 1em;">Suprimer</button>
                    </form>
                </div>
                <div class='box_main'>
                    <h2 style="text-align:center;">Ajouter Atelier</h2>
                    <form action="admin_ateliers_action.php" method="post"><!-- formulaire d'ajout d'atelier -->
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label>Titre</label>
                                <input type="titre" name="atl_intitule_ajout" class="form-control" id="inputtitre" placeholder="Titre">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Texte</label>
                                <input type="text" name="atl_texte" class="form-control" id="inputtexte" placeholder="Texte">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">État</label>
                                <select id="inputState" name="atl_etat" class="form-control">
                                    <option value="A">A</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Pad</label>
                                <select id="inputState" name="pad_id" class="form-control">
                                    <?php while ($result_all_pad_tab = $result_all_pad->fetch_assoc()) { ?><!--crée le tableaux associatif du résultat de la requete pour chaque ligne-->
                                        <option value="<?php echo $result_all_pad_tab['pad_id'] ?>"><?php echo $result_all_pad_tab['pad_intitule'] ?></option><!--crée un choix avec la valeur des id de pad et qui affiche les titre des pad-->
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom:1em; margin-left: 1em;">Ajouter</button>
                    </form>
                </div>
                <div class='box_main' style="display:none;" id="modifatelier">
                    <h2 style="text-align:center;">Modifier Atelier</h2>
                    <form action="admin_ateliers_action.php" method="post" id="modifatelierform"><!-- formulaire de modification d'atelier -->
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label>Titre</label>
                                <input type="titre" name="atl_intitule_modif" class="form-control" id="inputtitre" placeholder="Titre">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Texte</label>
                                <input type="text" name="atl_texte" class="form-control" id="inputtexte" placeholder="Texte">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">État</label>
                                <select id="inputState" name="atl_etat" class="form-control">
                                    <option selected value="A">A</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Pad</label>
                                <select id="inputState" name="pad_id" class="form-control">
                                    <?php $result_all_pad = $mysqli->query($requete_all_pad);// execute la requete
                                    error_requete($result_all_pad);// verification erreur
                                    while ($result_all_pad_tab = $result_all_pad->fetch_assoc()) { ?><!--crée le tableaux associatif du résultat de la requete pour chaque ligne-->
                                        <option value="<?php echo $result_all_pad_tab['pad_id'] ?>"><?php echo $result_all_pad_tab['pad_intitule'] ?></option><!--crée un choix avec la valeur des id de pad et qui affiche les titre des pad-->
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="atl_numero" value="<?php echo $result_intitule_pad_atl_tab['atl_etat'] ?>"><!--input hidden pour stocker l'information sans la voir-->
                        <button type="submit" class="btn btn-primary" style="margin-bottom:1em; margin-left: 1em;">Modifier</button>
                    </form>
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

        function modifier_atl(i) { // permet de préremplir le formulaire grace a l'id variable
            var box = document.getElementById('modifatelier');
            box.style.display = "";
            var tdtab = document.getElementById(i);
            var formresult = document.getElementById("modifatelierform");
            var tab = tdtab.children;
            formresult[0].value = tab[2].innerHTML;
            formresult[1].value = tab[5].innerHTML;
            for(var j=0;j<formresult[3].length;j++){
                if(formresult[3][j].innerHTML==tab[0].innerHTML){
                    formresult[3][j].selected=true;
                }
            }
            formresult[2][1].selected=(tab[6].innerHTML=='C') ? true : false ;
            formresult[4].value=tab[7].innerHTML;
        }
    </script>
</body>

</html>
<?php $mysqli->close(); ?>