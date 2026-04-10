<?php
$pageTitle = "Supprimer Catégorie";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 p-md-5 text-center">
                <div class="display-4 text-danger mb-4">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                
                <h2 class="fw-bold mb-3">Supprimer la catégorie ?</h2>
                <p class="text-muted mb-5">
                    Êtes-vous sûr de vouloir supprimer la catégorie <span class="fw-bold text-dark">"<?= htmlspecialchars($category->getName()) ?>"</span> ? 
                    <br><small class="text-secondary">(Les recettes associées ne seront pas supprimées mais n'auront plus de catégorie)</small>
                </p>

                <form action="index.php?action=categories_delete&id=<?= $category->getId() ?>" method="POST">
                    <input type="hidden" name="confirm" value="1">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger py-2">
                            <i class="bi bi-trash me-2"></i> Confirmer la suppression
                        </button>
                        <a href="index.php?action=categories" class="btn btn-outline-secondary py-2">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>