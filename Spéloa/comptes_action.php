<?php

session_start();// demare la session

if (!isset($_SESSION['login'])) {// verifie si la variable existe
    header("Location:session.php");
    exit();
}

$mysqli = new mysqli('localhost', 'zrousvaro', '2phkvttc', 'zfl2-zrousvaro_1');// connection base de données

if ($mysqli->connect_errno) {// verification erreur
    echo "Error: Problème de connexion à la BDD \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
}
if (!$mysqli->set_charset("utf8")) {// verification erreur
    printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
}

if (isset($_POST['pfl_nom_A'])) {//verifie si $_POST['pfl_nom_A'] existe, permet de savoir qu'elle formulaire a été poster 
    $nom = htmlspecialchars(addslashes($_POST['pfl_nom_A']));// Atribution des variables
    $prenom = htmlspecialchars(addslashes($_POST['pfl_prenom_A']));// Atribution des variables
    $password = htmlspecialchars(addslashes($_POST['cpt_mot_de_passe_A']));// Atribution des variables
    if($nom==null || $prenom==null || $password==null){ //verifie si les champ on bien été remplis
        header("Location: admin_accueil.php");
    }
    $requete_modif_compte = "UPDATE t_profil_pfl
                               SET pfl_nom='" . $nom . "',pfl_prenom='" . $prenom . "'
                               WHERE cpt_pseudo='" . $_SESSION['login'] . "';
                               UPDATE t_compte_cpt
                               SET cpt_mot_de_passe=MD5('" . $password . "')
                               WHERE cpt_pseudo='" . $_SESSION['login'] . "';";//requete qui modifier le compte et profil
    $result_modif_compte = $mysqli->multi_query($requete_modif_compte);// execute les requetes
    if ($result_modif_compte == false) {// verification erreur
        echo "Error: La requête a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
    } else {
        header("Location: admin_accueil.php");
    }
}

if (isset($_POST['pfl_nom_R'])) {
    $pseudo = htmlspecialchars(addslashes($_POST['cpt_pseudo_R']));// Atribution des variables
    $nom = htmlspecialchars(addslashes($_POST['pfl_nom_R']));// Atribution des variables
    $prenom = htmlspecialchars(addslashes($_POST['pfl_prenom_R']));// Atribution des variables
    $role = htmlspecialchars(addslashes($_POST['pfl_role_R']));// Atribution des variables
    $validite = htmlspecialchars(addslashes($_POST['plf_validite_R']));// Atribution des variables
    if($nom==null || $prenom==null || ($role!='A' && $role!='R') || ($validite!='A' && $validite!='D')){
        header("Location: admin_accueil.php");
    }
    $requete_modif_compte = "UPDATE t_profil_pfl
                               SET pfl_nom='" . $nom . "',pfl_prenom='" . $prenom . "'
                               ,pfl_role='" . $role . "',pfl_validite='" . $validite . "'
                               WHERE cpt_pseudo='" . $pseudo . "';";// requete qui modifie le profil
    $result_modif_compte = $mysqli->query($requete_modif_compte);// execute la requete
    if ($result_modif_compte == false) {// verification erreur
        echo "Error: La requête a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
    } else {
        header("Location: admin_accueil.php");
    }
}

if (isset($_POST['cpt_pseudo_V'])) {
    $pseudo = htmlspecialchars(addslashes($_POST['cpt_pseudo_V']));// Atribution des variables
    $requetemodifval = "UPDATE t_profil_pfl
                               SET pfl_validite=IF(pfl_validite='D','A','D')
                               WHERE cpt_pseudo='" . $pseudo . "';";// requete qui modifie la validité
    $resultmodifval = $mysqli->query($requetemodifval);// execute la requete
    if ($resultmodifval == false) {// verification erreur
        echo "Error: La requête a echoué \n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
    } else {
        header("Location: admin_accueil.php");
    }
}

$mysqli->close();
?>