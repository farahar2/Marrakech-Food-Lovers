<?php
$pageTitle = "Catégories";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 fw-bold mb-1">Nos <span class="text-brand">Catégories</span></h1>
            <p class="text-muted">Explorez nos spécialités par type de plat.</p>
        </div>
        <a href="index.php?action=categories_create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Nouvelle catégorie
        </a>
    </div>

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

    <?php if (empty($categories)): ?>
        <div class="text-center py-5">
            <p class="text-muted">Aucune catégorie pour le moment. Créez-en une !</p>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($categories as $cat): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center">

                        <h4 class="fw-bold mb-2"><?= htmlspecialchars($cat->getName()) ?></h4>
                        <p class="text-muted small mb-4">
                            <span class="badge bg-soft-green text-brand px-3 py-2 rounded-pill" style="background: #f0f9eb;">
                                <?= $cat->countRecipes() ?> recette(s)
                            </span>
                        </p>
                        <div class="d-flex justify-content-center gap-2 mt-auto">
                            <a href="index.php?action=categories_edit&id=<?= $cat->getId() ?>" class="btn btn-soft-light btn-sm px-3 rounded-pill" style="background: #f8f9fa;">
                                <i class="bi bi-pencil me-1"></i> Modifier
                            </a>
                            <a href="index.php?action=categories_delete&id=<?= $cat->getId() ?>" class="btn btn-outline-danger btn-sm px-3 rounded-pill">
                                <i class="bi bi-trash me-1"></i> Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>