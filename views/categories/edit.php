<?php
session_start();
$pageTitle = "Modifier Catégorie";
require_once __DIR__ . '/../layouts/header.php';
?>

<h1>✏️ Modifier la Catégorie</h1>

<form action="index.php?action=categories_update" method="POST">
    <input type="hidden" name="id" value="<?= $category->getId() ?>">
    
    <div class="form-group">
        <label for="name">Nom de la catégorie *</label>
        <input type="text" id="name" name="name" required maxlength="50" value="<?= htmlspecialchars($category->getName()) ?>">
    </div>
    
    <button type="submit" class="btn">💾 Mettre à jour</button>
    <a href="index.php?action=categories" class="btn btn-secondary">❌ Annuler</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>