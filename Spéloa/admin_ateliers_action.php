<?php
session_start();// demare la session

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
if (isset($_POST['atl_intitule_supr'])) { //verifie si $_POST['atl_intitule_supr'] existe, permet de savoir qu'elle formulaire a été poster 
    $atl_intitule = htmlspecialchars(addslashes($_POST['atl_intitule_supr']));// Atribution des variables
    $requete_supr_atl = "DELETE FROM t_atelier_atl
                            WHERE atl_intitule='" . $atl_intitule . "';"; // requete supression atelier en focntion de sont titre
    $result_supr_atl = $mysqli->query($requete_supr_atl);// execute la requete
    if ($result_supr_atl == false) { // verification erreur
        echo "Error: La requête a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
    } else {
        header("Location:admin_ateliers.php");
    }
}else if(isset($_POST['atl_intitule_ajout'])){//verifie si $_POST['atl_intitule_ajout'] existe, permet de savoir qu'elle formulaire a été poster 
    $atl_intitule = htmlspecialchars(addslashes($_POST['atl_intitule_ajout']));// Atribution des variables
    $atl_texte=htmlspecialchars(addslashes($_POST['atl_texte']));// Atribution des variables
    $atl_etat=htmlspecialchars(addslashes($_POST['atl_etat']));// Atribution des variables
    $pad_id=htmlspecialchars(addslashes($_POST['pad_id']));// Atribution des variables

    $requete_ajout_atl = "INSERT INTO t_atelier_atl (atl_intitule,atl_date,atl_texte,atl_etat,pad_id)
                          VALUES('".$atl_intitule."',NOW(0),'".$atl_texte."','".$atl_etat."','".$pad_id."');";// requete insertion atelier
    $result_ajout_atl = $mysqli->query($requete_ajout_atl);// execute la requete
    if ($result_ajout_atl == false) { // verification erreur
        echo "Error: La requête a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
    } else {
        header("Location:admin_ateliers.php");
    }
}else if(isset($_POST['atl_intitule_modif'])){//verifie si $_POST['atl_intitule_modif'] existe, permet de savoir qu'elle formulaire a été poster 
    $atl_intitule = htmlspecialchars(addslashes($_POST['atl_intitule_modif']));// Atribution des variables
    $atl_texte=htmlspecialchars(addslashes($_POST['atl_texte']));// Atribution des variables
    $atl_etat=htmlspecialchars(addslashes($_POST['atl_etat']));// Atribution des variables
    $pad_id=htmlspecialchars(addslashes($_POST['pad_id']));// Atribution des variables
    $atl_numero=htmlspecialchars(addslashes($_POST['atl_numero']));// Atribution des variables

    $requete_modif_atl="UPDATE t_atelier_atl
                        SET atl_intitule='".$atl_intitule."',
                        atl_texte='".$atl_texte."',
                        atl_etat='".$atl_etat."',
                        pad_id='".$pad_id."'
                        WHERE atl_numero='".$atl_numero."';";// requete modification d'un atelier en fonction de sont numéro
    $result_modif_atl = $mysqli->query($requete_modif_atl); // execute la requete         
    if ($result_modif_atl == false) { // verification erreur
        echo "Error: La requête a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
    } else {
        header("Location:admin_ateliers.php");
    }
}else{
header("Location:index.php");
}
?>