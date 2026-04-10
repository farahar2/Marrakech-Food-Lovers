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
        (new CategoryController())->create();        <?php
        <?php
        session_start();
        
        // Sanitize action
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? 'home';
        
        switch ($action) {
            // Accueil
            case 'home':
                require __DIR__ . '/views/home.php';
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
            
            // Recettes
            case 'recipes':
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->index();
                break;
            
            case 'recipes_show':
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if (!$id) {
                    header('Location: index.php?action=recipes');
                    exit;
                }
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->show($id);
                break;
            
            case 'recipes_create':
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->create();
                break;
            
            case 'recipes_edit':
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if (!$id) {
                    header('Location: index.php?action=recipes');
                    exit;
                }
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->edit($id);
                break;
            
            case 'recipes_delete':
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if (!$id) {
                    header('Location: index.php?action=recipes');
                    exit;
                }
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->delete($id);
                break;
            
            default:
                http_response_code(404);
                echo "404 - Page introuvable";
                break;
        }        <?php
        <?php
        session_start();
        
        // Sanitize action
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? 'home';
        
        switch ($action) {
            // Accueil
            case 'home':
                require __DIR__ . '/views/home.php';
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
            
            // Recettes
            case 'recipes':
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->index();
                break;
            
            case 'recipes_show':
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if (!$id) {
                    header('Location: index.php?action=recipes');
                    exit;
                }
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->show($id);
                break;
            
            case 'recipes_create':
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->create();
                break;
            
            case 'recipes_edit':
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if (!$id) {
                    header('Location: index.php?action=recipes');
                    exit;
                }
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->edit($id);
                break;
            
            case 'recipes_delete':
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if (!$id) {
                    header('Location: index.php?action=recipes');
                    exit;
                }
                require_once 'controllers/RecipeController.php';
                (new RecipeController())->delete($id);
                break;
            
            default:
                http_response_code(404);
                echo "404 - Page introuvable";
                break;
        }
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