<?php
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

    if (isset($pseudo) && isset($password)) {

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
    } else {
    }
}
?>
