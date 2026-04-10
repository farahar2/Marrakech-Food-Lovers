<?php
$pageTitle = "Supprimer la recette";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="mb-4">
    <a href="index.php?action=recipes" class="text-muted text-decoration-none small">
        <i class="bi bi-arrow-left me-1"></i> Retour aux recettes
    </a>
    <h1 class="page-title mt-2"><i class="bi bi-trash me-2 text-danger"></i>Supprimer la recette</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-danger border-2">
            <div class="card-header" style="background: linear-gradient(135deg,#e74c3c,#c0392b);">
                <i class="bi bi-exclamation-triangle"></i> Confirmation de suppression
            </div>
            <div class="card-body p-4">
                <p class="mb-3">
                    Êtes-vous sûr de vouloir supprimer la recette
                    <strong>"<?= htmlspecialchars($recipe->getTitle()) ?>"</strong> ?
                </p>

                <div class="alert alert-warning d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                    Cette action est <strong>irréversible</strong>. La recette sera définitivement supprimée.
                </div>

                <!-- Résumé rapide de la recette -->
                <div class="bg-light rounded-3 p-3 mb-4">
                    <div class="d-flex gap-3 flex-wrap">
                        <span class="text-muted small">
                            <i class="bi bi-clock me-1"></i><?= $recipe->getPrepTime() ?> min prépa
                        </span>
                        <?php if ($recipe->getCookTime() > 0): ?>
                            <span class="text-muted small">
                                <i class="bi bi-fire me-1"></i><?= $recipe->getCookTime() ?> min cuisson
                            </span>
                        <?php endif; ?>
                        <span class="text-muted small">
                            <i class="bi bi-people me-1"></i><?= $recipe->getPortions() ?> portions
                        </span>
                    </div>
                </div>

                <form action="index.php?action=recipes_delete&id=<?= $recipe->getId() ?>" method="POST">
                    <input type="hidden" name="confirm" value="1">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger flex-fill py-2">
                            <i class="bi bi-trash me-1"></i> Confirmer la suppression
                        </button>
                        <a href="index.php?action=recipes" class="btn btn-outline-secondary flex-fill py-2">
                            <i class="bi bi-x-lg me-1"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
