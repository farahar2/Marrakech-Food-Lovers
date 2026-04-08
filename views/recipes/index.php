<?php
// Démarre la session si pas encore démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../layouts/header.php';
?>
<link rel="stylesheet" href="/public/css/styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<div class="container mt-4">

    <!-- ── Flash message ──────────────────────────────────────────────── -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <?php
            $flash     = $_SESSION['flash'];
            $alertType = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
            unset($_SESSION['flash']);           // On consomme le message
        ?>
        <div class="alert <?= $alertType ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- ── En-tête ────────────────────────────────────────────────────── -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">🍽️ Recettes de Marrakech</h1>

        <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="index.php?page=recipes&action=create" class="btn btn-primary">
                + Nouvelle recette
            </a>
        <?php endif; ?>
    </div>

    <!-- ── Info utilisateur connecté ─────────────────────────────────── -->
    <?php if (!empty($_SESSION['user_id'])): ?>
        <p class="text-muted small mb-3">
            Connecté en tant que <strong><?= htmlspecialchars($_SESSION['username'] ?? '') ?></strong>
        </p>
    <?php endif; ?>

    <!-- ── Grille de recettes ─────────────────────────────────────────── -->
    <?php if (empty($recipes)): ?>
        <p class="text-muted">Aucune recette pour le moment. Soyez le premier à en ajouter une !</p>

    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($recipes as $recipe): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">

                            <?php if ($recipe['category_name']): ?>
                                <span class="badge bg-warning text-dark mb-2">
                                    <?= htmlspecialchars($recipe['category_name']) ?>
                                </span>
                            <?php endif; ?>

                            <h5 class="card-title">
                                <?= htmlspecialchars($recipe['title']) ?>
                            </h5>

                            <p class="card-text text-muted small">
                                ⏱ Prépa : <?= $recipe['prep_time'] ?> min
                                <?php if ($recipe['cook_time'] > 0): ?>
                                    &nbsp;|&nbsp; 🔥 Cuisson : <?= $recipe['cook_time'] ?> min
                                <?php endif; ?>
                                &nbsp;|&nbsp; 🍴 <?= $recipe['portions'] ?> portions
                            </p>

                            <p class="card-text small text-muted">
                                Par <strong><?= htmlspecialchars($recipe['username']) ?></strong>
                            </p>

                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">

                            <a href="index.php?page=recipes&action=show&id=<?= $recipe['id'] ?>"
                               class="btn btn-sm btn-outline-primary">Voir</a>

                            <!-- Boutons edit / delete : uniquement pour l'auteur -->
                            <?php if (!empty($_SESSION['user_id']) && (int)$_SESSION['user_id'] === (int)$recipe['user_id']): ?>
                                <div class="d-flex gap-1">
                                    <a href="index.php?page=recipes&action=edit&id=<?= $recipe['id'] ?>"
                                       class="btn btn-sm btn-outline-secondary">Modifier</a>

                                    <form method="POST"
                                          action="index.php?page=recipes&action=delete&id=<?= $recipe['id'] ?>"
                                          onsubmit="return confirm('Supprimer cette recette ?')">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>