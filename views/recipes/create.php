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
?>

<div class="container mt-4" style="max-width: 700px;">

    <h1 class="h3 mb-4">➕ Nouvelle recette</h1>

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

    <form method="POST" action="index.php?page=recipes&action=create">

        <!-- Titre -->
        <div class="mb-3">
            <label for="title" class="form-label">
                Titre <span class="text-danger">*</span>
            </label>
            <input type="text" id="title" name="title" class="form-control"
                   value="<?= htmlspecialchars($data['title'] ?? '') ?>" required>
        </div>

        <!-- Catégorie -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">-- Sans catégorie --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                        <?= (isset($data['category_id']) && (int)$data['category_id'] === (int)$cat['id']) ? 'selected' : '' ?>>
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
            <textarea id="ingredients" name="ingredients" class="form-control" rows="5"
                      placeholder="Un ingrédient par ligne..." required><?= htmlspecialchars($data['ingredients'] ?? '') ?></textarea>
        </div>

        <!-- Instructions -->
        <div class="mb-3">
            <label for="instructions" class="form-label">
                Instructions <span class="text-danger">*</span>
            </label>
            <textarea id="instructions" name="instructions" class="form-control" rows="6"
                      placeholder="Étapes de préparation..." required><?= htmlspecialchars($data['instructions'] ?? '') ?></textarea>
        </div>

        <!-- Temps + portions -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="prep_time" class="form-label">
                    Préparation (min) <span class="text-danger">*</span>
                </label>
                <input type="number" id="prep_time" name="prep_time" class="form-control"
                       min="1" value="<?= (int)($data['prep_time'] ?? '') ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="cook_time" class="form-label">Cuisson (min)</label>
                <input type="number" id="cook_time" name="cook_time" class="form-control"
                       min="0" value="<?= (int)($data['cook_time'] ?? 0) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="portions" class="form-label">Portions</label>
                <input type="number" id="portions" name="portions" class="form-control"
                       min="1" value="<?= (int)($data['portions'] ?? 4) ?>">
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Créer la recette</button>
            <a href="index.php?page=recipes" class="btn btn-outline-secondary">Annuler</a>
        </div>

    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>