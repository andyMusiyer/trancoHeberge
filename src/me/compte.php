<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionpremier.html");
    exit();
}

// Données utilisateur depuis la session
$user = [
    'id' => $_SESSION['user_id'],
    'nom' => $_SESSION['nom'],
    'prenom' => $_SESSION['prenom'],
    'email' => $_SESSION['email'],
    'numero' => $_SESSION['numero'] ?? 'Non renseigné',
    'abo' => $_SESSION['abonnement'],
    'jeton' => $_SESSION['jeton'],
    'abonnement_exprire' => $_SESSION['abonnement_exprire'] ?? "pas d'abonnement actif",
    'status' => $_SESSION['status'],
    'lastLogin' => $_SESSION['lastLogin'],
    'date' => $_SESSION['createdAt'],
    'updatedAt' => $_SESSION['updatedAt'] ?? 'N/A',
];

$abonnements = ['basic' => 'Basic', 'populaire' => 'Populaire', 'etudiant' => 'Étudiant'];
$statusColors = ['actif' => '#27ae60', 'inactif' => '#e67e22', 'banni' => '#e74c3c'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>compte</title>
    <link rel="stylesheet" href="../look.css">
</head>
<body>

  <nav class="navbar">
    <div class="navbar-left">
      <a href="index.html"><img src="logo.png" alt="Logo" class="logo"></a>
      <a href="course.html">Course</a>
    </div>
    <div class="navbar-right">
    <!-- reservation bouton  --> 
<a class="menu__link" href="revervation.html">Reservation</a>
<a href="compte.php">
  <button id="btn-message" class="button-message">
	<div class="content-avatar">
		<div class="status-user"></div>
		<div class="avatar">
			<svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
		</div>
	</div>
	<div class="notice-content">
		<div class="username"><?php echo htmlspecialchars($user['email']); ?></div>
		<div class="lable-message"><?php echo htmlspecialchars($user['prenom']); ?> <?php echo htmlspecialchars($user['nom']); ?></div>
		<div class="user-id"></div>
	</div>
</button>
</a>
    </div>
  </nav>
    <!-- SECTION : Mon compte -->
        <section id="compte" class="section">
            <h1 class="page-title">Mon compte</h1>
            
            <div class="account-table">
                <table>
                    
                    <tr>
                        <th>Nom</th>
                        <td><?php echo htmlspecialchars($user['nom']); ?></td>
                    </tr>
                    <tr>
                        <th>Prénom</th>
                        <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Numéro de téléphone</th>
                        <td><?php echo htmlspecialchars($user['numero']); ?></td>
                    </tr>
                    <tr>
                        <th>Abonnement</th>
                        <td><span style="color: #1abc9c; font-weight: bold;"><?php echo $abonnements[$user['abonnement']] ?? $user['abonnement']; ?></span></td>
                    </tr>
                    <tr>
                        <th>Jetons</th>
                        <td><?php echo $user['jeton']; ?></td>
                    </tr>
                    <tr>
                        <th>Expiration abonnement</th>
                        <td><?php echo $user['abonnement_exprire'] ? date('d/m/Y', strtotime($user['abonnement_exprire'])) : 'Non défini'; ?></td>
                    </tr>
                    <tr>
                        <th>Statut</th>
                        <td><span style="color: <?php echo $statusColors[$user['status']] ?? '#333'; ?>; font-weight: bold;"><?php echo ucfirst($user['status']); ?></span></td>
                    </tr>
                    <tr>
                        <th>Dernière connexion</th>
                        <td><?php echo $user['lastLogin'] ? date('d/m/Y H:i:s', strtotime($user['lastLogin'])) : 'Jamais'; ?></td>
                    </tr>
                    <tr>
                        <th>Compte créé le</th>
                        <td><?php echo $user['createdAt'] ? date('d/m/Y', strtotime($user['createdAt'])) : 'N/A'; ?></td>
                    </tr>
                    <tr>
                        <th>Dernière mise à jour</th>
                        <td><?php echo $user['updatedAt'] ? date('d/m/Y H:i:s', strtotime($user['updatedAt'])) : 'N/A'; ?></td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 20px; text-align: right;">
                <a href="modifier_profil.php" class="plan-btn plan-btn-primary">✏️ Modifier mon profil</a>
            </div>
        </section>

</body>
</html>