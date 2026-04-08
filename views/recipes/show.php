<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4" style="max-width: 800px;">

    <a href="index.php?page=recipes" class="btn btn-sm btn-outline-secondary mb-3">← Retour à la liste</a>

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Catégorie + titre -->
            <?php if ($recipe['category_name']): ?>
                <span class="badge bg-warning text-dark mb-2">
                    <?= htmlspecialchars($recipe['category_name']) ?>
                </span>
            <?php endif; ?>

            <h1 class="h3 mb-3"><?= htmlspecialchars($recipe['title']) ?></h1>

            <!-- Méta -->
            <ul class="list-inline text-muted small mb-4">
                <li class="list-inline-item">⏱ Prépa : <strong><?= $recipe['prep_time'] ?> min</strong></li>
                <?php if ($recipe['cook_time'] > 0): ?>
                    <li class="list-inline-item">🔥 Cuisson : <strong><?= $recipe['cook_time'] ?> min</strong></li>
                <?php endif; ?>
                <li class="list-inline-item">🍴 <strong><?= $recipe['portions'] ?> portions</strong></li>
                <li class="list-inline-item">👤 Par <strong><?= htmlspecialchars($recipe['username']) ?></strong></li>
            </ul>

            <hr>

            <!-- Ingrédients -->
            <h5>📋 Ingrédients</h5>
            <p style="white-space: pre-line;"><?= htmlspecialchars($recipe['ingredients']) ?></p>

            <hr>

            <!-- Instructions -->
            <h5>👨‍🍳 Instructions</h5>
            <p style="white-space: pre-line;"><?= htmlspecialchars($recipe['instructions']) ?></p>

        </div>

        <!-- Actions auteur -->
        <?php if (!empty($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe['user_id']): ?>
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