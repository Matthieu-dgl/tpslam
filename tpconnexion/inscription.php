<html lang="fr">
<body>
<h1>Inscription</h1>
<form action="inscription.php" method="post" onsubmit="return validerFormulaire();">
    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="S'inscrire">
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
            $sql = "INSERT INTO contact (pseudo, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$pseudo, $password]);
            session_start();
            echo "Inscription réussie.";
            header("Location: index.php");
        }
    } else {
        // Gérer le cas où les données pseudo et motdepasse ne sont pas définies
    }
}
?>
