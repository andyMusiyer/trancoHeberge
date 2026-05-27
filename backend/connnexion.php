<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nom, prenom, mot_de_passe , numero, jeton , abonnement , createdAt FROM users1 WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['email'] = $email;
            $_SESSION['jeton'] = $user['jeton'];
            $_SESSION['numero'] = $user['numero'];
            $_SESSION['abonnement'] = $user['abo'];
            $_SESSION['createdAt'] = $user['date'];

               echo '
                  
            <div class="loaderbody">
                <!-- From Uiverse.io by barisdogansutcu --> 
                <svg viewBox="25 25 50 50" style="display:block;">
                    <circle r="20" cy="50" cx="50"></circle>
                </svg>
            </div>
                    <
       '; 
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Email introuvable";
    }
}
?>

  <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link rel="stylesheet" href="../src/play.css">
            </head>
            <body>
                        <script>
                            setTimeout(() => {
                                window.location.href = "../src/me/dashboard.php";
                            }, 5000); // redirection après 3 secondes
                        </script>
            </body>
            </html>
       
