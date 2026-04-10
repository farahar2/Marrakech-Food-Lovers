<?php
$pageTitle = "Accueil";
require_once __DIR__ . '/layouts/header.php';
?>

<!-- Hero -->
<div class="text-center py-5 mb-5"
     style="background-color: var(--brand-main);
            border-radius: var(--border-radius-xl); color:#fff; padding: 80px 24px !important;">
    <div style="font-size:4rem; margin-bottom:16px; line-height:1;">🌍</div>
    <h1 class="fw-bold mb-3" style="font-size:3rem; letter-spacing:-1px;">Bienvenue sur MaraFood</h1>
    <p class="opacity-75 mb-5" style="font-size:1.2rem; font-weight:500;">
        Découvrez et partagez les saveurs authentiques de Marrakech.
    </p>
    <div class="d-flex gap-3 justify-content-center flex-wrap">
        <a href="index.php?action=categories" class="btn btn-light text-dark fw-bold px-4 py-3 rounded-pill shadow-sm" style="font-size:1.1rem;">
            Parcourir les catégories
        </a>
        <a href="index.php?action=recipes" class="btn border-white text-white fw-bold px-4 py-3 rounded-pill" style="font-size:1.1rem;">
            Voir toutes les recettes
        </a>
    </div>
</div>

<!-- Quick links en cartes rondes "Jow" -->
<div class="row g-4 justify-content-center">
    <div class="col-md-5">
        <a href="index.php?action=recipes" class="text-decoration-none">
            <div class="card h-100 text-center" style="border-radius: var(--border-radius-xl); padding: 40px; border:2px solid transparent; transition: border-color 0.2s;">
                <div style="font-size:3rem; color:var(--brand-main); margin-bottom:16px;"><i class="bi bi-journal-check"></i></div>
                <h3 class="fw-bold text-dark mb-2">Les Recettes</h3>
                <p class="text-muted" style="font-weight:500;">Explorez ou partagez vos meilleures créations culinaires marocaines.</p>
            </div>
        </a>
    </div>
    <div class="col-md-5">
        <a href="index.php?action=categories" class="text-decoration-none">
            <div class="card h-100 text-center" style="border-radius: var(--border-radius-xl); padding: 40px; border:2px solid transparent; transition: border-color 0.2s;">
                <div style="font-size:3rem; color:var(--brand-main); margin-bottom:16px;"><i class="bi bi-grid-fill"></i></div>
                <h3 class="fw-bold text-dark mb-2">Les Catégories</h3>
                <p class="text-muted" style="font-weight:500;">Naviguez par type de plat, des tajines savoureux aux desserts fondants.</p>
            </div>
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
