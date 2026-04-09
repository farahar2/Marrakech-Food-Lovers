<?php
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    private $model;
    
    public function __construct() {
        $this->model = new Category();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Liste des catégories
    public function index() {
        $categories = $this->model->getAll();
        require_once __DIR__ . '/../views/categories/index.php';
    }
    
    // Formulaire création
    public function create() {
        require_once __DIR__ . '/../views/categories/create.php';
    }
    
    // Enregistrer
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=categories');
            exit;
        }
        
        try {
            $this->model->setName($_POST['name'] ?? '');
            
            if ($this->model->create()) {
                $_SESSION['success'] = "✅ Catégorie créée avec succès";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('Location: index.php?action=categories');
        exit;
    }
    
    // Formulaire édition
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?action=categories');
            exit;
        }
        
        if ($this->model->getById($_GET['id'])) {
            $category = $this->model;
            require_once __DIR__ . '/../views/categories/edit.php';
        } else {
            $_SESSION['error'] = "Catégorie introuvable";
            header('Location: index.php?action=categories');
            exit;
        }
    }
    
    // Mettre à jour
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=categories');
            exit;
        }
        
        try {
            if ($this->model->getById($_POST['id'])) {
                $this->model->setName($_POST['name'] ?? '');
                
                if ($this->model->update()) {
                    $_SESSION['success'] = "✅ Catégorie modifiée";
                }
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        
        header('Location: index.php?action=categories');
        exit;
    }
    
    // Supprimer (VERSION SIMPLIFIÉE)
    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?action=categories');
            exit;
        }
        
        if ($this->model->getById($_GET['id'])) {
            // Si confirmation
            if (isset($_POST['confirm'])) {
                try {
                    if ($this->model->delete()) {
                        $_SESSION['success'] = "✅ Catégorie supprimée (les recettes liées sont maintenant sans catégorie)";
                    }
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                }
                header('Location: index.php?action=categories');
                exit;
            }
            
            // Afficher confirmation
            $category = $this->model;
            require_once __DIR__ . '/../views/categories/delete.php';
        } else {
            $_SESSION['error'] = "Catégorie introuvable";
            header('Location: index.php?action=categories');
            exit;
        }
    }
}
?>