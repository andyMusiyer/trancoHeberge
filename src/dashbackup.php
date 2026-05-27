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
    'abonnement' => $_SESSION['abonnement'],
    'jeton' => $_SESSION['jeton'],
    'abonnement_exprire' => $_SESSION['abonnement_exprire'],
    'status' => $_SESSION['status'],
    'lastLogin' => $_SESSION['lastLogin'],
    'createdAt' => $_SESSION['createdAt'] ?? 'N/A',
    'updatedAt' => $_SESSION['updatedAt'] ?? 'N/A',
];

$abonnements = ['basic' => 'Basic', 'populaire' => 'Populaire', 'etudiant' => 'Étudiant'];
$statusColors = ['actif' => '#27ae60', 'inactif' => '#e67e22', 'banni' => '#e74c3c'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashstyle.css">
</head>
<body>

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar">
        <div class="nav-left">
            <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a href="#" class="logo">
                <!-- Remplace l'URL ici par ton logo -->
                <img src="https://via.placeholder.com/35" alt="Logo">
                MonApp
            </a>
        </div>
        <button class="user-btn" onclick="showSection('compte')">
            <div class="icon-user">👤</div>
            <span class="user-name"><?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></span>
        </button>
    </nav>

    <!-- Overlay mobile -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar" id="sidebar">
        
        <!-- Carte utilisateur -->
       
        <!-- Menu -->
        <div class="menu-section">
            <div class="menu-title">Menu principal</div>
            <a href="#" class="menu-item active" onclick="showSection('dashboard'); return false;">
                <span class="icon">📊</span> Tableau de bord
            </a>
            <a href="#" class="menu-item" onclick="showSection('compte'); return false;">
                <span class="icon">👤</span> Mon compte
            </a>
            <a href="#" class="menu-item" onclick="showSection('abonnement'); return false;">
                <span class="icon">💎</span> Mon abonnement
            </a>
            <a href="#" class="menu-item" onclick="showSection('reservations'); return false;">
                <span class="icon">📅</span> Mes réservations
            </a>
        </div>

        <div class="divider"></div>

        <div class="menu-section">
            <div class="menu-title">Paramètres</div>
            <a href="#" class="menu-item" onclick="showSection('parametres'); return false;">
                <span class="icon">⚙️</span> Paramètres
            </a>
        </div>

        <div class="divider"></div>

        <!-- Déconnexion -->
        <a href="deconnexion.php" class="logout-btn">
            <span class="icon">🚪</span> Se déconnecter
        </a>
    </aside>

    <!-- ==================== CONTENU PRINCIPAL ==================== -->
    <main class="main-content" id="mainContent">

        <!-- SECTION : Tableau de bord -->
        <section id="dashboard" class="section active">
            <h1 class="page-title">Bienvenue, <?php echo htmlspecialchars($user['prenom']); ?> 👋</h1>
            
            <div class="info-grid">
                <div class="info-card">
                    <h3>Abonnement actuel</h3>
                    <div class="value"><?php echo $abonnements[$user['abonnement']] ?? $user['abonnement']; ?></div>
                    <div class="sub">Expire le <?php echo $user['abonnement_exprire'] ? date('d/m/Y', strtotime($user['abonnement_exprire'])) : 'Jamais'; ?></div>
                </div>
                <div class="info-card">
                    <h3>Jetons disponibles</h3>
                    <div class="value"><?php echo $user['jeton']; ?></div>
                    <div class="sub">Utilisés pour les réservations</div>
                </div>
                <div class="info-card">
                    <h3>Dernière connexion</h3>
                    <div class="value"><?php echo $user['lastLogin'] ? date('d/m/Y H:i', strtotime($user['lastLogin'])) : 'Jamais'; ?></div>
                    <div class="sub">IP : <?php echo $_SERVER['REMOTE_ADDR']; ?></div>
                </div>
                <div class="info-card">
                    <h3>Statut du compte</h3>
                    <div class="value" style="color: <?php echo $statusColors[$user['status']] ?? '#333'; ?>">
                        <?php echo ucfirst($user['status']); ?>
                    </div>
                    <div class="sub">Compte créé le <?php echo $user['createdAt']; ?></div>
                </div>
            </div>

            <div class="alert alert-info">
                💡 <strong>Astuce :</strong> Passe à l'abonnement <strong>Populaire</strong> pour bénéficier de plus de jetons et d'avantages exclusifs !
            </div>
        </section>

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

        <!-- SECTION : Mon abonnement -->
        <section id="abonnement" class="section">
            <h1 class="page-title">Mon abonnement</h1>
            
            <div class="alert alert-info">
                Abonnement actuel : <strong><?php echo $abonnements[$user['abonnement']] ?? $user['abonnement']; ?></strong> 
                — Expire le <strong><?php echo $user['abonnement_exprire'] ? date('d/m/Y', strtotime($user['abonnement_exprire'])) : 'Non défini'; ?></strong>
            </div>

            <div class="plans-grid">
                <!-- Plan Basic -->
                <div class="plan-card <?php echo $user['abonnement'] === 'basic' ? 'current' : ''; ?>">
                    <?php if ($user['abonnement'] === 'basic') echo '<div class="current-badge">ACTUEL</div>'; ?>
                    <div class="plan-name">Basic</div>
                    <div class="plan-price">Gratuit<span>/mois</span></div>
                    <ul class="plan-features">
                        <li>5 jetons/mois</li>
                        <li>Réservations standard</li>
                        <li>Support email</li>
                        <li>Accès limité</li>
                    </ul>
                    <?php if ($user['abonnement'] !== 'basic'): ?>
                        <button class="plan-btn plan-btn-outline" onclick="changerAbonnement('basic')">Choisir Basic</button>
                    <?php else: ?>
                        <button class="plan-btn plan-btn-primary" disabled>Abonnement actuel</button>
                    <?php endif; ?>
                </div>

                <!-- Plan Populaire -->
                <div class="plan-card <?php echo $user['abonnement'] === 'populaire' ? 'current' : ''; ?>">
                    <?php if ($user['abonnement'] === 'populaire') echo '<div class="current-badge">ACTUEL</div>'; ?>
                    <div class="plan-name">Populaire</div>
                    <div class="plan-price">9,99€<span>/mois</span></div>
                    <ul class="plan-features">
                        <li>50 jetons/mois</li>
                        <li>Réservations prioritaires</li>
                        <li>Support prioritaire</li>
                        <li>Accès complet</li>
                        <li>Statistiques avancées</li>
                    </ul>
                    <?php if ($user['abonnement'] !== 'populaire'): ?>
                        <button class="plan-btn plan-btn-primary" onclick="changerAbonnement('populaire')">Choisir Populaire</button>
                    <?php else: ?>
                        <button class="plan-btn plan-btn-primary" disabled>Abonnement actuel</button>
                    <?php endif; ?>
                </div>

                <!-- Plan Étudiant -->
                <div class="plan-card <?php echo $user['abonnement'] === 'etudiant' ? 'current' : ''; ?>">
                    <?php if ($user['abonnement'] === 'etudiant') echo '<div class="current-badge">ACTUEL</div>'; ?>
                    <div class="plan-name">Étudiant</div>
                    <div class="plan-price">4,99€<span>/mois</span></div>
                    <ul class="plan-features">
                        <li>25 jetons/mois</li>
                        <li>Réservations standard</li>
                        <li>Support email</li>
                        <li>Accès complet</li>
                        <li>Vérification étudiante requise</li>
                    </ul>
                    <?php if ($user['abonnement'] !== 'etudiant'): ?>
                        <button class="plan-btn plan-btn-outline" onclick="changerAbonnement('etudiant')">Choisir Étudiant</button>
                    <?php else: ?>
                        <button class="plan-btn plan-btn-primary" disabled>Abonnement actuel</button>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- SECTION : Mes réservations -->
        <section id="reservations" class="section">
            <h1 class="page-title">Mes réservations</h1>
            <div class="alert alert-info">
                📅 Cette section affichera tes réservations. Tu peux la connecter à ta base de données.
            </div>
        </section>

        <!-- SECTION : Paramètres -->
        <section id="parametres" class="section">
            <h1 class="page-title">Paramètres</h1>
            <div class="alert alert-info">
                ⚙️ Cette section permettra de modifier les paramètres du compte.
            </div>
        </section>

    </main>

    <script>
        // ==================== GESTION SIDEBAR ====================
        const sidebar = document.getElementById('sidebar');
        const hamburger = document.getElementById('hamburger');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');

        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('open');
                hamburger.classList.toggle('active');
                overlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('hidden');
                mainContent.classList.toggle('full');
            }
        }

        // Fermer sidebar au redimensionnement
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open');
                hamburger.classList.remove('active');
                overlay.classList.remove('active');
            }
        });

        // ==================== GESTION SECTIONS ====================
        function showSection(sectionId) {
            // Masquer toutes les sections
            document.querySelectorAll('.section').forEach(sec => {
                sec.classList.remove('active');
            });
            
            // Afficher la section demandée
            document.getElementById(sectionId).classList.add('active');
            
            // Mettre à jour le menu actif
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Trouver le menu item correspondant
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                if (item.getAttribute('onclick') && item.getAttribute('onclick').includes(sectionId)) {
                    item.classList.add('active');
                }
            });

            // Fermer sidebar sur mobile après clic
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('open');
                hamburger.classList.remove('active');
                overlay.classList.remove('active');
            }
        }

        // ==================== CHANGEMENT ABONNEMENT ====================
        function changerAbonnement(plan) {
            if (confirm('Voulez-vous vraiment changer votre abonnement pour "' + plan + '" ?')) {
                // Redirection vers le script PHP de changement
                window.location.href = 'changer_abonnement.php?plan=' + plan;
            }
        }
    </script>

</body>
</html> 