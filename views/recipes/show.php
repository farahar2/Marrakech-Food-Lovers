<?php
require __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5">

    <!-- ── Back Link ────────────────────────────────────────────────── -->
    <a href="index.php?action=recipes" class="text-brand text-decoration-none fw-bold small mb-4 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Retour aux recettes
    </a>

    <!-- ── Recipe Header ────────────────────────────────────────────── -->
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-5">
            <div class="recipe-card__img-container bg-soft-green rounded-4 shadow-sm" style="height: 350px; font-size: 8rem; background: #f0f9eb;">
                🍲
            </div>
        </div>
        <div class="col-lg-7">
            <div class="recipe-header">
                <?php if ($recipe['category_name']): ?>
                    <span class="badge-category mb-3 d-inline-block">
                        <?= htmlspecialchars($recipe['category_name']) ?>
                    </span>
                <?php endif; ?>
                
                <h1 class="display-5 fw-bold mb-4"><?= htmlspecialchars($recipe['title']) ?></h1>
                
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <div class="recipe-meta-item">
                        <i class="bi bi-clock-fill text-brand"></i>
                        <strong><?= $recipe['prep_time'] ?> min</strong> <span class="text-muted">Prépa</span>
                    </div>
                    <?php if ($recipe['cook_time'] > 0): ?>
                        <div class="recipe-meta-item">
                            <i class="bi bi-fire text-orange"></i>
                            <strong><?= $recipe['cook_time'] ?> min</strong> <span class="text-muted">Cuisson</span>
                        </div>
                    <?php endif; ?>
                    <div class="recipe-meta-item">
                        <i class="bi bi-egg-fill text-brand"></i>
                        <strong><?= $recipe['portions'] ?></strong> <span class="text-muted">Portions</span>
                    </div>
                    <div class="recipe-meta-item">
                        <i class="bi bi-person-fill"></i>
                        <span class="text-muted">Par</span> <strong><?= htmlspecialchars($recipe['username']) ?></strong>
                    </div>
                </div>

                <?php if (!empty($_SESSION['user_id']) && (int)$_SESSION['user_id'] === (int)$recipe['user_id']): ?>
                    <div class="d-flex gap-2">
                        <a href="index.php?action=recipes_edit&id=<?= $recipe['id'] ?>" class="btn btn-outline-secondary btn-sm px-4">Modifier</a>
                        <form method="POST" action="index.php?action=recipes_delete&id=<?= $recipe['id'] ?>" onsubmit="return confirm('Supprimer cette recette ?')">
                            <button type="submit" class="btn btn-outline-danger btn-sm px-4">Supprimer</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ── Recipe Content ──────────────────────────────────────────── -->
    <div class="row g-5">
        <!-- Ingredients -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 h-100" style="background-color: #fcfdfb;">
                <h4 class="recipe-section-title mt-0">Ingrédients</h4>
                <div class="text-seconday lh-lg">
                    <?= nl2br(htmlspecialchars($recipe['ingredients'])) ?>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="col-md-7">
            <div class="p-2">
                <h4 class="recipe-section-title mt-0">Instructions</h4>
                <div class="text-secondary lh-lg fs-5" style="white-space: pre-line;">
                    <?= htmlspecialchars($recipe['instructions']) ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>