<?php
session_start();
$pageTitle = "Supprimer Catégorie";
require_once __DIR__ . '/../layouts/header.php';
?>

<h1>🗑️ Supprimer la Catégorie</h1>

<div class="alert alert-error">
    ⚠️ Êtes-vous sûr de vouloir supprimer <strong><?= htmlspecialchars($category->getName()) ?></strong> ?
</div>

<div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 5px;">
    <strong>ℹ️ Information importante :</strong><br>
    Cette catégorie contient actuellement <strong><?= $category->countRecipes() ?> recette(s)</strong>.<br>
    Si vous la supprimez, ces recettes seront <strong>sans catégorie</strong> (category_id = NULL).
</div>

<form action="index.php?action=categories_delete&id=<?= $category->getId() ?>" method="POST">
    <input type="hidden" name="confirm" value="1">
    <button type="submit" class="btn btn-danger">🗑️ Confirmer la suppression</button>
    <a href="index.php?action=categories" class="btn btn-secondary">❌ Annuler</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>