<?php
$pageTitle = "Supprimer la recette";
require __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 p-md-5 text-center">
                <div class="display-4 text-danger mb-4">
                    <i class="bi bi-trash3"></i>
                </div>
                
                <h2 class="fw-bold mb-3">Supprimer la recette ?</h2>
                <p class="text-muted mb-5">
                    Êtes-vous sûr de vouloir supprimer la recette <span class="fw-bold text-dark">"<?= htmlspecialchars($recipe['title']) ?>"</span> ?
                    <br><small class="text-danger fw-bold">Cette action est irréversible.</small>
                </p>

                <form action="index.php?action=recipes_delete&id=<?= $recipe['id'] ?>" method="POST">
                    <input type="hidden" name="confirm" value="1">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger py-2">
                            <i class="bi bi-trash me-2"></i> Confirmer la suppression
                        </button>
                        <a href="index.php?action=recipes_show&id=<?= $recipe['id'] ?>" class="btn btn-outline-secondary py-2">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
