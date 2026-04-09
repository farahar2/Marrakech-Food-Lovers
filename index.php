<?php
session_start();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    // Accueil
    case 'home':
        echo '<h1 style="text-align:center; padding:100px;">🍴 Bienvenue sur MaraFood</h1>';
        echo '<div style="text-align:center;">';
        echo '<a href="index.php?action=categories" style="padding:15px 30px; background:#667eea; color:white; text-decoration:none; border-radius:5px; margin:10px;">📂 Catégories</a>';
        echo '<a href="index.php?action=recipes" style="padding:15px 30px; background:#764ba2; color:white; text-decoration:none; border-radius:5px; margin:10px;">🍜 Recettes</a>';
        echo '</div>';
        break;
    
    // Catégories
    case 'categories':
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->index();
        break;
    
    case 'categories_create':
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->create();
        break;
    
    case 'categories_store':
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->store();
        break;
    
    case 'categories_edit':
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->edit();
        break;
    
    case 'categories_update':
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->update();
        break;
    
    case 'categories_delete':
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->delete();
        break;
    
    // Recettes (à implémenter)
    case 'recipes':
        echo "Module Recettes - À développer";
        break;
    
    default:
        echo "404 - Page introuvable";
        break;
}
?>