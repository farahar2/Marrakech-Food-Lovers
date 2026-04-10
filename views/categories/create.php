<?php
$pageTitle = "Nouvelle Catégorie";
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="index.php?action=categories" class="text-brand text-decoration-none fw-bold small mb-4 d-inline-block">
                <i class="bi bi-arrow-left me-1"></i> Annuler et retourner aux catégories
            </a>

            <div class="card border-0 shadow-sm p-4 p-md-5">
                <div class="mb-4 text-center">
                    <h2 class="fw-bold">Créer une Catégorie</h2>
                    <p class="text-muted small">Organisez vos recettes par thématiques.</p>
                </div>

                <form action="index.php?action=categories_store" method="POST">
                    <div class="mb-4">
                        <label for="name" class="form-label small fw-bold">Nom de la catégorie <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" 
                               required maxlength="50" placeholder="Ex: Entrées, Plats, Desserts...">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-check-circle me-1"></i> Enregistrer la catégorie
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>