<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

// Vérifie si la connexion à la base est établie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des données
    $nom = htmlspecialchars($_POST['nom'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $telephone = preg_replace('/[^0-9]/', '', $_POST['telephone'] ?? '');
    $evenement = htmlspecialchars($_POST['evenement'] ?? '');

    // Validation
    if (empty($nom) || empty($email) || empty($telephone) || empty($evenement)) {
        die("⚠️ Tous les champs doivent être remplis.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Format d'email invalide");
    }

    // Préparation de la requête
    $sql = "INSERT INTO participants (nom, email, telephone, evenement) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("❌ Erreur de préparation: " . $conn->error);
    }

    $stmt->bind_param("ssss", $nom, $email, $telephone, $evenement);

    if ($stmt->execute()) {
        // Affichage message + redirection après 3 secondes via JavaScript et meta refresh
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="3;url=list.php">
            <title>Inscription réussie</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f8f9fa;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    margin: 0;
                }
                .message {
                    background-color: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                    padding: 20px 40px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                a {
                    color: #155724;
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class="message">
                <p>✅ Inscription réussie !</p>
                <p>Redirection vers la <a href="list.php">liste des participants</a> dans <span id="timer">3</span> secondes...</p>
            </div>
            <script>
                let seconds = 3;
                const timerElement = document.getElementById('timer');
                const countdown = setInterval(() => {
                    seconds--;
                    timerElement.textContent = seconds;
                    if (seconds <= 0) {
                        clearInterval(countdown);
                        window.location.href = 'list.php';
                    }
                }, 1000);
            </script>
        </body>
        </html>
        <?php
        exit; // Stop le script après affichage
    } else {
        echo "❌ Erreur d'exécution: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "⛔ Méthode non autorisée.";
}

$conn->close();
?>
