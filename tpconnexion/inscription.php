<?php
session_start();

include ('hhf/head.php');
?>
<html lang="fr">
<body>
<h1>Inscription</h1>
<form action="inscription.php" method="post" onsubmit="return validerFormulaire();">
    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="confirm_password">Confirmez le mot de passe :</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <input type="submit" value="S'inscrire"><br>
    <button name="Connexion"><a href="connexion.php">Vous avez un compte ?</a></button>

</form>
</body>
</html>

<?php

include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"]; 

    if (isset($pseudo) && isset($password) && isset($confirm_password)) {

        if ($password !== $confirm_password) {
            echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
        } else {
            $checkQuery = "SELECT COUNT(*) FROM contact WHERE pseudo = ?";
            $checkStmt = $pdo->prepare($checkQuery);
            $checkStmt->execute([$pseudo]);
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                echo "Le pseudo existe déjà. Veuillez en choisir un autre.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO contact (pseudo, password) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$pseudo, $hashedPassword]);

                session_start();
                echo "Inscription réussie.";
                header("Location: index.php");
            }
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
}

?>
