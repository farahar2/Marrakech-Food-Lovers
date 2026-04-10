<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marrakech Food Lovers 🌍</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Nos styles personnalisés -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<!--   Barre de navigation  -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">

        <!-- Logo / Nom du site -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <span style="font-size: 1.5rem;">🌍</span>
            <span>Marrakech <span class="text-orange">Food</span> Lovers</span>
        </a>

        <!-- Bouton hamburger (mobile) -->
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link px-3" href="index.php?action=recipes">
                        <i class="bi bi-book me-1"></i> Recettes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="index.php?action=categories">
                        <i class="bi bi-tags me-1"></i> Catégories
                    </a>
                </li>
            </ul>

            <!-- Côté droit : connexion / déconnexion -->
            <ul class="navbar-nav ms-auto align-items-center">
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <li class="nav-item me-3">
                        <span class="nav-link text-main small">
                            <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm px-4" href="index.php?action=logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-2">
                        <a class="nav-link px-3" href="index.php?action=login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm px-4" href="index.php?action=register">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav>

<main class="flex-grow-1">
