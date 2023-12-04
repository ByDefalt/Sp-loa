<?php
    session_start(); //demare la session
    unset($_SESSION['login']); //libere la mémoire des variables
    unset($_SESSION['role']);
    session_destroy(); // détruit la session
    header("Location: index.php"); // redirection
?>