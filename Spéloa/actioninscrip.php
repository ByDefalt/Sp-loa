<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php

    $nom = htmlspecialchars(addslashes($_POST['nom'])); // crée les varibles
    $prenom = htmlspecialchars(addslashes($_POST['prenom'])); // crée les varibles
    $email = htmlspecialchars(addslashes($_POST['email'])); // crée les varibles
    $password = htmlspecialchars(addslashes($_POST['password'])); // crée les varibles
    $confirmpassword = htmlspecialchars(addslashes($_POST['confirmpassword'])); // crée les varibles
    $message = ""; // crée les varibles
    ?>
    <form action="inscription.php" id="formulaire" method="post" style="padding-top: 1em;"><!-- crée un formulaire prérempli avec les inforamtion-->

        <div class="form-group">
            <input type="hidden" class="form-control" id="Inputnom" name="nom" placeholder="Nom" required maxlength="60" value="<?php if ($nom != null) {
                                                                                                                                    echo $nom;
                                                                                                                                } ?>">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="Inputprenom" name="prenom" placeholder="Prénom" required maxlength="60" value="<?php if ($prenom != null) {
                                                                                                                                                echo $prenom;
                                                                                                                                            } ?>">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="InputEmail" name="email" placeholder="Email" required maxlength="60" value="<?php if ($email != null) {
                                                                                                                                            echo $email;
                                                                                                                                        } ?>">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="InputPassword1" name="password" placeholder="Password" required value="<?php if ($password != null) {
                                                                                                                                        echo $password;
                                                                                                                                    } ?>">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="Inputcomfirmpassword" name="confirmpassword" placeholder="Comfirm Password" required value="<?php if ($confirmpassword != null) {
                                                                                                                                                            echo $confirmpassword;
                                                                                                                                                        } ?>">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="Inputmessage" name="message" value=""><!-- permet de poster un message -->
        </div>
    </form>
    <?php



    if ($nom == null || $prenom == null || $email == null || $password == null || $confirmpassword == null) { //verifie si les champ on bien été remplis
    ?><script>
            var formulaire = document.getElementById('formulaire');
            var message = document.getElementById('Inputmessage');
            message.value = 'Champ non compléter'; //modifie le message et submit le formulaire
            formulaire.submit();
        </script>
    <?php exit();
    }
    if (strlen($nom) > 60 || strlen($prenom) > 60 || strlen($email) > 60) { //verifie si les longeur son bonne
    ?><script>
            var formulaire = document.getElementById('formulaire');
            var message = document.getElementById('Inputmessage');
            message.value = 'Trop de caractère'; //modifie le message et submit le formulaire
            formulaire.submit();
        </script>
    <?php exit();
    }
    $equalpassword = strcmp($password, $confirmpassword);
    if ($equalpassword != 0) { //verifie si les mot de passe sont égaux
    ?><script>
            var formulaire = document.getElementById('formulaire');
            var message = document.getElementById('Inputmessage');
            message.value = 'Mot de passe et Mot de passe de confirmation ne sont pas les mêmes'; //modifie le message et submit le formulaire
            formulaire.submit();
        </script>
    <?php exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //verifie si l'email est valide
    ?><script>
            var formulaire = document.getElementById('formulaire');
            var message = document.getElementById('Inputmessage');
            message.value = 'Email non valide'; //modifie le message et submit le formulaire
            formulaire.submit();
        </script>
        <?php exit();
    }
    $mysqli = new mysqli('localhost', 'zrousvaro', '2phkvttc', 'zfl2-zrousvaro_1'); // connection base de données

    if ($mysqli->connect_errno) { // verification erreur
        echo "Error: Problème de connexion à la BDD \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
    }
    if (!$mysqli->set_charset("utf8")) { // verification erreur
        printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
    } else {
        $requeteinsertcompte = "INSERT INTO t_compte_cpt
                                VALUES ('" . $email . "',MD5('" . $password . "'));"; // requete pour inserer un compte
        $resultinsertcompte = $mysqli->query($requeteinsertcompte); // execute la requete
        if ($resultinsertcompte == false) { // verification erreur
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
        ?><script>
                var formulaire = document.getElementById('formulaire');
                var message = document.getElementById('Inputmessage');
                message.value = 'Compte déja existant';//modifie le message et submit le formulaire
                formulaire.submit();
            </script>
    <?php
        } else {
            $requeteinsertprofil = "INSERT INTO t_profil_pfl
                                    VALUES ('" . $nom . "','" . $prenom . "','A','D',CURRENT_TIMESTAMP(0),'" . $email . "');"; // requete pour inserer un profil
            $resultinsertprofil = $mysqli->query($requeteinsertprofil); // execute la requete
            if ($resultinsertprofil == false) { // verification erreur et execution d'une requete en cas d'érreur
                echo "Error: La requête a echoué \n";
                echo "Errno: " . $mysqli->errno . "\n";
                echo "Error: " . $mysqli->error . "\n";
                $requetesupressioncompte = "DELETE FROM t_compte_cpt
                                            WHERE cpt_pseudo='" . $email . "'AND cpt_mot_de_passe=MD5('" . $password . "');";// requete pour suprimer un compte
                $resultsupressioncompte = $mysqli->query($requetesupressioncompte); // execute la requete
                if ($resultsupressioncompte == false) { // verification erreur
                    echo "Error: La requête a echoué \n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                }
            }
        }
    }
    $mysqli->close(); ?>


    <script>
        alert('Compte et Profil crées avec Succès');
        document.location.href = 'index.php';
    </script>


</body>

</html>