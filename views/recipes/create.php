<?php
$pageTitle = "Proposer une recette";
require __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="index.php?action=recipes" class="text-brand text-decoration-none fw-bold small mb-4 d-inline-block">
                <i class="bi bi-arrow-left me-1"></i> Annuler et retourner aux recettes
            </a>

            <div class="card border-0 shadow-sm p-4 p-md-5">
                <div class="mb-4">
                    <h2 class="fw-bold mb-1">🥘 Proposer une <span class="text-brand">Recette</span></h2>
                    <p class="text-muted">Partagez votre passion et vos secrets culinaires.</p>
                </div>

                <!-- ── Flash message ──────────────────────────────────────── -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger border-0 small mb-4">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?action=recipes_create">
                    
                    <h5 class="recipe-section-title mt-0 small mb-4">Informations générales</h5>

                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="title" class="form-label small fw-bold">Titre de la recette <span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title" class="form-control"
                               placeholder="Ex: Tajine d'agneau aux pruneaux"
                               value="<?= htmlspecialchars($data['title'] ?? '') ?>" required>
                    </div>

                    <!-- Catégorie -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label small fw-bold">Catégorie</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="">-- Sélectionner une catégorie --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat->getId() ?>"
                                    <?= (isset($data['category_id']) && (int)$data['category_id'] === (int)$cat->getId()) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat->getName()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-4">
                            <label for="prep_time" class="form-label small fw-bold">Préparation (min) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-clock"></i></span>
                                <input type="number" id="prep_time" name="prep_time" class="form-control"
                                       min="1" value="<?= (int)($data['prep_time'] ?? '') ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="cook_time" class="form-label small fw-bold">Cuisson (min)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-fire"></i></span>
                                <input type="number" id="cook_time" name="cook_time" class="form-control"
                                       min="0" value="<?= (int)($data['cook_time'] ?? 0) ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="portions" class="form-label small fw-bold">Portions</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-people"></i></span>
                                <input type="number" id="portions" name="portions" class="form-control"
                                       min="1" value="<?= (int)($data['portions'] ?? 4) ?>">
                            </div>
                        </div>
                    </div>

                    <h5 class="recipe-section-title small mb-4">Contenu de la recette</h5>

                    <!-- Ingrédients -->
                    <div class="mb-4">
                        <label for="ingredients" class="form-label small fw-bold">Ingrédients <span class="text-danger">*</span></label>
                        <textarea id="ingredients" name="ingredients" class="form-control" rows="5"
                                  placeholder="Listez vos ingrédients (un par ligne...)" required><?= htmlspecialchars($data['ingredients'] ?? '') ?></textarea>
                    </div>

                    <!-- Instructions -->
                    <div class="mb-5">
                        <label for="instructions" class="form-label small fw-bold">Instructions étape par étape <span class="text-danger">*</span></label>
                        <textarea id="instructions" name="instructions" class="form-control" rows="8"
                                  placeholder="Détaillez les étapes de préparation..." required><?= htmlspecialchars($data['instructions'] ?? '') ?></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-3">
                            <i class="bi bi-send-check me-2"></i> Publier ma recette
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>