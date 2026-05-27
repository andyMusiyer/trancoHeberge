

<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nom'];
    $prenom = $_POST['prenom']; 
    $email = $_POST['email'];
    $tele = $_POST['telephone'];
    $password = $_POST['password'];

    $hashpassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users1 (nom, prenom, email, numero, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $name, $prenom, $email, $tele, $hashpassword);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['nom'] = $name;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['email'] = $email;

       echo '

        <div class="parent">
            <svg viewBox="25 25 50 50">
            <circle r="20" cy="50" cx="50"></circle>
            </svg>

        </div>
       
       '; 
    } else {
        echo "Erreur lors de l'inscription";
    }
}
?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
.parent{
    display: flex; 
    justify-content: center;
    align-items: center;
    height: 100vh;
}

svg {
 width: 3.25em;
 transform-origin: center;
 animation: rotate4 2s linear infinite;
}

circle {
 fill: none;
 stroke: hsl(214, 97%, 59%);
 stroke-width: 4;
 stroke-dasharray: 1, 200;
 stroke-dashoffset: 0;
 stroke-linecap: round;
 animation: dash4 1.5s ease-in-out infinite;
}

@keyframes rotate4 {
 100% {
  transform: rotate(360deg);
 }
}

@keyframes dash4 {
 0% {
  stroke-dasharray: 1, 200;
  stroke-dashoffset: 0;
 }

 50% {
  stroke-dasharray: 90, 200;
  stroke-dashoffset: -35px;
 }

 100% {
  stroke-dashoffset: -125px;
 }
}

    </style>
</head>
<body>
           <script>
                setTimeout(() => {
                    window.location.href = "../src/dashboard.php";
                }, 5000); // redirection après 3 secondes
            </script>
</body>
</html>
    