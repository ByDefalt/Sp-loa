<?php
session_start(); // demare la session

$email = htmlspecialchars(addslashes($_POST['email'])); // Atribution des variables
$password = htmlspecialchars(addslashes($_POST['password'])); // Atribution des variables

if ($email == null || $password == null) { //verifie si les champ on bien été remplis
?>
    <script>
        var formulaire = document.getElementById('formulaire');
        formulaire.submit();// submit le formulaire
    </script>
<?php exit();
}
$mysqli = new mysqli('localhost', 'zrousvaro', '2phkvttc', 'zfl2-zrousvaro_1'); // connection base de données

if ($mysqli->connect_errno) {// verification erreur
    echo "Error: Problème de connexion à la BDD \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
}
if (!$mysqli->set_charset("utf8")) {// verification erreur
    printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
}
$requetevallogin = "SELECT * FROM t_compte_cpt
                            JOIN t_profil_pfl USING(cpt_pseudo)
                            WHERE cpt_pseudo='" . $email . "' 
                            AND cpt_mot_de_passe=MD5('" . $password . "') 
                            AND pfl_validite='A';"; //requete pour recupérer les informations du profil/compte quans le profil est valide

$resultvallogin = $mysqli->query($requetevallogin);// execute la requete
if ($resultvallogin == false) {// verification erreur
    echo "Error: La requête a echoué \n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
}
$resultvallogintab = $resultvallogin->fetch_assoc();// crée le tableaux associatif du résultat de la requete
if ($resultvallogin->num_rows == 1) {
    $_SESSION["login"] = $email;//Atribution des variables
    $_SESSION["role"] = $resultvallogintab['pfl_role'];//Atribution des variables
    header("Location:admin_accueil.php");
} else {
?>
    <script>
        var formulaire = document.getElementById('formulaire');
        formulaire.submit();// submit le formulaire
    </script>
<?php
    header("Location:session.php");
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <form action="session.php" id="formulaire" method="post" style="padding-top: 1em;"><!--formulaire pour re-remplir le login en cas d'erreur-->

        <div class="form-group">
            <input type="hidden" class="form-control" id="InputEmail" name="email" placeholder="Email" required maxlength="60" value="<?php if ($email != null) {
                                                                                                                                            echo $email;
                                                                                                                                        } ?>">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="Inputpassword" name="confirmpassword" placeholder="Comfirm Password" required value="<?php if ($password != null) {
                                                                                                                                                    echo $password;
                                                                                                                                                } ?>">
        </div>
    </form>
</body>

</body>

</html>