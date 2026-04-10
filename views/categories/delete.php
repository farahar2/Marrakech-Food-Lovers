<?php
$pageTitle = "Supprimer Catégorie";
require_once __DIR__ . '/../layouts/header.php';
?>

<h1>🗑️ Supprimer la Catégorie</h1>

<div class="alert alert-error">
    ⚠️ Êtes-vous sûr de vouloir supprimer <strong><?= htmlspecialchars($category->getName()) ?></strong> ?
</div>


<form action="index.php?action=categories_delete&id=<?= $category->getId() ?>" method="POST">
    <input type="hidden" name="confirm" value="1">
    <button type="submit" class="btn btn-danger">🗑️ Confirmer la suppression</button>
    <a href="index.php?action=categories" class="btn btn-secondary">❌ Annuler</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>