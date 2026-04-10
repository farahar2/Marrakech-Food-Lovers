<?php
$pageTitle = "Recettes";
require __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5">

    <!-- ── Flash message ──────────────────────────────────────────────── -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <?php
            $flash     = $_SESSION['flash'];
            $alertType = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
            unset($_SESSION['flash']);
        ?>
        <div class="alert <?= $alertType ?> alert-dismissible fade show rounded-pill px-4 mb-5 border-0 shadow-sm" role="alert">
            <i class="bi <?= $flash['type'] === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?> me-2"></i>
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- ── Header ────────────────────────────────────────────────────── -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h1 class="h2 fw-bold mb-1">Nos <span class="text-brand">Recettes</span></h1>
            <p class="text-muted mb-0">Découvrez le meilleur de la gastronomie marocaine.</p>
        </div>

        <a href="index.php?action=recipes_create" class="btn btn-primary d-inline-flex align-items-center">
            <i class="bi bi-plus-lg me-2"></i> Proposer une recette
        </a>
    </div>

    <!-- ── Content ───────────────────────────────────────────────────── -->
    <?php if (empty($recipes)): ?>
        <div class="text-center py-5">
            <div class="display-1 text-muted opacity-25 mb-4"><i class="bi bi-journal-x"></i></div>
            <h3 class="fw-bold">Aucune recette trouvée</h3>
            <p class="text-muted">Soyez le premier à partager votre savoir-faire culinaire !</p>
        </div>

    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($recipes as $recipe): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <!-- Image Placeholder (Inspired by Manger Bouger/Healthy visual) -->
                        <div class="recipe-card__img-container">
                            <?php 
                                // Simple emoji-based icon if no image
                                $icons = ['🍲', '🥘', '🥙', '🥗', '🥣', '🍛'];
                                echo $icons[array_rand($icons)];
                            ?>
                        </div>

                        <div class="card-body p-4">
                            <?php if (!empty($recipe['category_name'])): ?>
                                <span class="badge-category mb-3 d-inline-block">
                                    <?= htmlspecialchars($recipe['category_name']) ?>
                                </span>
                            <?php endif; ?>

                            <h5 class="card-title fw-bold mb-3 h5 line-clamp-2" style="min-height: 3rem;">
                                <?= htmlspecialchars($recipe['title']) ?>
                            </h5>

                            <div class="d-flex gap-3 small text-muted mb-4">
                                <span class="d-flex align-items-center gap-1">
                                    <i class="bi bi-clock text-brand"></i> <?= $recipe['prep_time'] ?> min
                                </span>
                                <?php if ($recipe['cook_time'] > 0): ?>
                                    <span class="d-flex align-items-center gap-1">
                                        <i class="bi bi-fire text-orange"></i> <?= $recipe['cook_time'] ?> min
                                    </span>
                                <?php endif; ?>
                                <span class="d-flex align-items-center gap-1">
                                    <i class="bi bi-people"></i> <?= $recipe['portions'] ?> pers.
                                </span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="small">
                                    <span class="text-muted">Par</span> <span class="fw-bold"><?= htmlspecialchars($recipe['username']) ?></span>
                                </div>
                                <a href="index.php?action=recipes_show&id=<?= $recipe['id'] ?>" class="btn btn-outline-secondary btn-sm px-4 rounded-pill">
                                    Voir <i class="bi bi-chevron-right ms-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Actions bar (only for author) -->
                        <?php if (!empty($_SESSION['user_id']) && (int)$_SESSION['user_id'] === (int)$recipe['user_id']): ?>
                            <div class="card-footer bg-light border-0 d-flex gap-2 p-3 justify-content-end">
                                <a href="index.php?action=recipes_edit&id=<?= $recipe['id'] ?>" class="btn btn-link text-muted p-0 text-decoration-none small">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <form method="POST" action="index.php?action=recipes_delete&id=<?= $recipe['id'] ?>" onsubmit="return confirm('Supprimer cette recette ?')">
                                    <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none small ms-2">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>