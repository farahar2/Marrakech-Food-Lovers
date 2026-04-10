<?php
session_start();
$pageTitle = "Nouvelle Catégorie";
require_once __DIR__ . '/../layouts/header.php';
?>

<h1>➕ Créer une Catégorie</h1>

<form action="index.php?action=categories_store" method="POST">
    <div class="form-group">
        <label for="name">Nom de la catégorie *</label>
        <input type="text" id="name" name="name" required maxlength="50" placeholder="Ex: Desserts">
    </div>
    
    <button type="submit" class="btn">💾 Enregistrer</button>
    <a href="index.php?action=categories" class="btn btn-secondary">❌ Annuler</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>