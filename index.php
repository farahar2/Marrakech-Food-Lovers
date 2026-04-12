<?php
session_start();

function requireAuth()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
}

// Sanitize action
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? 'home';

switch ($action) {
    // Accueil
    case 'home':
        require __DIR__ . '/views/home.php';
        break;
    
    // Authentification
    case 'login':
        require_once 'controllers/AuthController.php';
        (new AuthController())->login();
        break;
    case 'register':
        require_once 'controllers/AuthController.php';
        (new AuthController())->register();
        break;
    case 'logout':
        require_once 'controllers/AuthController.php';
        (new AuthController())->logout();
        break;

    // Catégories
    case 'categories':
        requireAuth();
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->index();
        break;
    
    case 'categories_create':
        requireAuth();
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->create();
        break;
    
    case 'categories_store':
        requireAuth();
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->store();
        break;
    
    case 'categories_edit':
        requireAuth();
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->edit();
        break;
    
    case 'categories_update':
        requireAuth();
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->update();
        break;
    
    case 'categories_delete':
        requireAuth();
        require_once 'controllers/CategoryController.php';
        (new CategoryController())->delete();
        break;
    
    // Recettes
    case 'recipes':
        requireAuth();
        require_once 'controllers/RecipeController.php';
        (new RecipeController())->index();
        break;
    
    case 'recipes_show':
        requireAuth();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: index.php?action=recipes');
            exit;
        }
        require_once 'controllers/RecipeController.php';
        (new RecipeController())->show($id);
        break;
    
    case 'recipes_create':
        requireAuth();
        require_once 'controllers/RecipeController.php';
        (new RecipeController())->create();
        break;
    
    case 'recipes_edit':
        requireAuth();
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: index.php?action=recipes');
            exit;
        }
        require_once 'controllers/RecipeController.php';
        (new RecipeController())->edit($id);
        break;
    
    case 'recipes_delete':
        requireAuth();
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
?>