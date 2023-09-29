<?php

include ('hhf/head.php');
include ('hhf/header.php');

session_start();

    if (!isset($_SESSION['pseudo'])) {

        header("Location: connexion.php");

    exit();
}

?>

<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();

    if (isset($_SESSION['pseudo'])) {
        echo '<p>Bienvenue, ' . $_SESSION['pseudo'] . '!</p>';
        echo '<form action="deconnexion.php" method="post">';
        echo '<input type="submit" value="Se déconnecter">';
        echo '</form>';
    } else {
        echo '<p>Vous n\'êtes pas connecté.</p>';
    }
    ?>
</body>
</html>