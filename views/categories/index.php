<?php
session_start();
$pageTitle = "Gestion des Catégories";
require_once __DIR__ . '/../layouts/header.php';
?>

<h1>📂 Gestion des Catégories</h1>

<a href="index.php?action=categories_create" class="btn">➕ Nouvelle Catégorie</a>

<?php if (empty($categories)): ?>
    <p style="text-align: center; padding: 40px; color: #666;">
        Aucune catégorie. Créez-en une !
    </p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Recettes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat->getId() ?></td>
                    <td><strong><?= htmlspecialchars($cat->getName()) ?></strong></td>
                    <td><?= $cat->countRecipes() ?> recette(s)</td>
                    <td>
                        <a href="index.php?action=categories_edit&id=<?= $cat->getId() ?>" class="btn" style="padding: 5px 10px;">✏️ Modifier</a>
                        <a href="index.php?action=categories_delete&id=<?= $cat->getId() ?>" class="btn btn-danger" style="padding: 5px 10px;">🗑️ Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>