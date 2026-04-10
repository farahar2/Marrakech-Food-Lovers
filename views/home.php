<?php
$pageTitle = "Accueil";
require_once __DIR__ . '/layouts/header.php';
?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <span class="badge bg-soft-green text-brand mb-3 px-3 py-2 rounded-pill" style="background: #e9f5e1;">Le goût de l'authentique</span>
                <h1 class="display-4 fw-bold mb-4">Cuisinez le meilleur de <span class="text-brand">Marrakech</span></h1>
                <p class="lead text-muted mb-5">Découvrez des recettes traditionnelles, saines et gourmandes partagées par les amoureux de la ville ocre.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="index.php?action=recipes" class="btn btn-primary px-5 py-3">
                        <i class="bi bi-search me-2"></i> Explorer les recettes
                    </a>
                    <?php if (empty($_SESSION['user_id'])): ?>
                        <a href="index.php?action=register" class="btn btn-outline-secondary px-5 py-3">
                            Créer un compte
                        </a>
                    <?php else: ?>
                        <a href="index.php?action=recipes_create" class="btn btn-outline-secondary px-5 py-3">
                            <i class="bi bi-plus-lg me-2"></i> Partager une recette
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features / Quick Links -->
<div class="container mb-5">
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card h-100 p-4 border-0 shadow-sm text-center">
                <div class="mb-3 text-brand fs-1">
                    <i class="bi bi-patch-check"></i>
                </div>
                <h4 class="fw-bold">Qualité Garantie</h4>
                <p class="text-muted small">Des recettes testées et approuvées par notre communauté de gourmets.</p>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card h-100 p-4 border-0 shadow-sm text-center">
                <div class="mb-3 text-orange fs-1">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h4 class="fw-bold">Rapide & Facile</h4>
                <p class="text-muted small">Filtrez par temps de préparation pour trouver le plat idéal en un clin d'œil.</p>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card h-100 p-4 border-0 shadow-sm text-center">
                <div class="mb-3 text-brand fs-1">
                    <i class="bi bi-people"></i>
                </div>
                <h4 class="fw-bold">Communauté active</h4>
                <p class="text-muted small">Partagez vos astuces et échangez avec d'autres passionnés de cuisine.</p>
            </div>
        </div>
    </div>
</div>

<!-- Simple Separator -->
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <hr class="opacity-10 mb-5">
            <h2 class="fw-bold mb-4">Envie de voyager par l'assiette ?</h2>
            <p class="text-muted mb-4">Naviguez à travers nos catégories pour trouver votre prochain coup de cœur culinaire.</p>
            <a href="index.php?action=categories" class="btn btn-link text-brand fw-bold text-decoration-none">
                Voir toutes les catégories <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
