<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sécurité : si pas connecté, rediriger
if (empty($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

require __DIR__ . '/../layouts/header.php';

// Priorité : données saisies (si erreur de validation) sinon données BDD
$v = !empty($data) ? $data : $recipe;
?>

<div class="container mt-4" style="max-width: 700px;">

    <h1 class="h3 mb-4">✏️ Modifier la recette</h1>

    <!-- ── Erreurs de validation ──────────────────────────────────────── -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=recipes&action=edit&id=<?= $recipe['id'] ?>">

        <!-- Titre -->
        <div class="mb-3">
            <label for="title" class="form-label">
                Titre <span class="text-danger">*</span>
            </label>
            <input type="text" id="title" name="title" class="form-control"
                   value="<?= htmlspecialchars($v['title']) ?>" required>
        </div>

        <!-- Catégorie -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">-- Sans catégorie --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                        <?= ((int)($v['category_id'] ?? 0) === (int)$cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Ingrédients -->
        <div class="mb-3">
            <label for="ingredients" class="form-label">
                Ingrédients <span class="text-danger">*</span>
            </label>
            <textarea id="ingredients" name="ingredients" class="form-control"
                      rows="5" required><?= htmlspecialchars($v['ingredients']) ?></textarea>
        </div>

        <!-- Instructions -->
        <div class="mb-3">
            <label for="instructions" class="form-label">
                Instructions <span class="text-danger">*</span>
            </label>
            <textarea id="instructions" name="instructions" class="form-control"
                      rows="6" required><?= htmlspecialchars($v['instructions']) ?></textarea>
        </div>

        <!-- Temps + portions -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="prep_time" class="form-label">
                    Préparation (min) <span class="text-danger">*</span>
                </label>
                <input type="number" id="prep_time" name="prep_time" class="form-control"
                       min="1" value="<?= (int)$v['prep_time'] ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="cook_time" class="form-label">Cuisson (min)</label>
                <input type="number" id="cook_time" name="cook_time" class="form-control"
                       min="0" value="<?= (int)$v['cook_time'] ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="portions" class="form-label">Portions</label>
                <input type="number" id="portions" name="portions" class="form-control"
                       min="1" value="<?= (int)$v['portions'] ?>">
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="index.php?page=recipes&action=show&id=<?= $recipe['id'] ?>"
               class="btn btn-outline-secondary">Annuler</a>
        </div>

    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>