<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marrakech Food Lovers 🍽️</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Nos styles personnalisés -->
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>

<!--   Barre de navigation  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <!-- Logo / Nom du site -->
        <a class="navbar-brand fw-bold" href="index.php?page=recipes">
            🍽️ Marrakech Food Lovers
        </a>

        <!-- Bouton hamburger (mobile) -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=recipes">
                        Recettes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=categories">
                        Catégories
                    </a>
                </li>
            </ul>

            <!-- Côté droit : connexion / déconnexion -->
            <ul class="navbar-nav ms-auto">
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <span class="nav-link text-light">
                            👤 <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=register">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav>
