<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../layouts/header.php';
?>

<div class="container mt-4" style="max-width: 800px;">

    <!-- ── Flash message ──────────────────────────────────────────────── -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <?php
            $flash     = $_SESSION['flash'];
            $alertType = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
            unset($_SESSION['flash']);
        ?>
        <div class="alert <?= $alertType ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <a href="index.php?page=recipes" class="btn btn-sm btn-outline-secondary mb-3">
        ← Retour à la liste
    </a>

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Catégorie + titre -->
            <?php if ($recipe['category_name']): ?>
                <span class="badge bg-warning text-dark mb-2">
                    <?= htmlspecialchars($recipe['category_name']) ?>
                </span>
            <?php endif; ?>

            <h1 class="h3 mb-3"><?= htmlspecialchars($recipe['title']) ?></h1>

            <!-- Méta infos -->
            <ul class="list-inline text-muted small mb-4">
                <li class="list-inline-item">
                    ⏱ Prépa : <strong><?= $recipe['prep_time'] ?> min</strong>
                </li>
                <?php if ($recipe['cook_time'] > 0): ?>
                    <li class="list-inline-item">
                        🔥 Cuisson : <strong><?= $recipe['cook_time'] ?> min</strong>
                    </li>
                <?php endif; ?>
                <li class="list-inline-item">
                    🍴 <strong><?= $recipe['portions'] ?> portions</strong>
                </li>
                <li class="list-inline-item">
                    👤 Par <strong><?= htmlspecialchars($recipe['username']) ?></strong>
                </li>
            </ul>

            <hr>

            <h5>📋 Ingrédients</h5>
            <p style="white-space: pre-line;"><?= htmlspecialchars($recipe['ingredients']) ?></p>

            <hr>

            <h5>👨‍🍳 Instructions</h5>
            <p style="white-space: pre-line;"><?= htmlspecialchars($recipe['instructions']) ?></p>

        </div>

        <!-- Actions auteur (visible uniquement si connecté ET auteur) -->
        <?php if (!empty($_SESSION['user_id']) && (int)$_SESSION['user_id'] === (int)$recipe['user_id']): ?>
            <div class="card-footer d-flex gap-2">
                <a href="index.php?page=recipes&action=edit&id=<?= $recipe['id'] ?>"
                   class="btn btn-sm btn-outline-secondary">Modifier</a>

                <form method="POST"
                      action="index.php?page=recipes&action=delete&id=<?= $recipe['id'] ?>"
                      onsubmit="return confirm('Supprimer cette recette ?')">
                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>