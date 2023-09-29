<?php
include ('hhf/head.php');
?>

<html>
<body>
<h1>Connexion</h1>
<form action="connexion.php" method="post">
    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Se connecter"><br>
    <button name="Pas de compte"><a href="inscription.php">Pas de compte</a></button>
</form>
</body>
</html>

<?php
include_once ('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];

    $sql = "SELECT password FROM contact WHERE pseudo = :pseudo";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([':pseudo' => $pseudo]);
        $user = $stmt->fetch();
        $hashedPassword = $user['password'];
        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['pseudo'] = $pseudo;
            header("Location: index.php");
            exit();
        } else {
            echo "Authentification échouée. Veuillez réessayer.";
        }
    } catch (PDOException $e) {
        echo "Erreur d'authentification : " . $e->getMessage();
    }
}
?>

