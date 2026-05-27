<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>check up </title>
</head>
<link rel="stylesheet" href="style/style.css">

<body>
  <?php
$servername = "localhost";
$username = "root"; // par défaut
$password = "";     // vide par défaut
$dbname = "transco_users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
    echo "<script>
            alert('pas de connexion cote bd '); 

          </script>"; 
}else {
    echo '<script>
      console.log("pas de connexion avec la base de données "); 
    </script>'; 
}
?>

  
</body><script src="style/index.js"></script>
</html>