<?php
// Connexion à la base
$host = 'db';
$dbname = 'site_web';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifiez si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Préparer et exécuter la requête d'insertion
        $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
        ]);

        echo "Données insérées avec succès !";
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<?php
try {
    $sql = "SELECT * FROM user";
    $stmt = $pdo->query($sql);

    echo "<h2>Liste des utilisateurs :</h2>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p>Nom d'utilisateur : " . htmlspecialchars($row['username']) . "<br>";
        echo "Email : " . htmlspecialchars($row['email']) . "</p>";
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
