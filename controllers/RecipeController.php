<?php

require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';

class RecipeController
{
    private Recipe   $recipeModel;
    //private Category $categoryModel;

    public function __construct()
    {
        // Démarre la session si pas encore démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->recipeModel   = new Recipe();
        //$this->categoryModel = new Category();
    }

    // List
    public function index(): void
    {
        $recipes = $this->recipeModel->getAll();
        require __DIR__ . '/../views/recipes/index.php';
    }

    // Details
    public function show(int $id): void
    {
        $recipe = $this->recipeModel->getById($id);

        if (!$recipe) {
            $this->setFlash('error', 'Recette introuvable.');
            $this->redirect('recipes');
        }

        require __DIR__ . '/../views/recipes/show.php';
    }

    // Create
    public function create(): void
    {
        $this->requireLogin();

        //$categories = $this->categoryModel->getAll();
        $errors     = [];
        $data       = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeInput($_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                $data['user_id'] = $_SESSION['user_id'];
                $this->recipeModel->create($data);

                $this->setFlash('success', 'Recette créée avec succès !');
                $this->redirect('recipes');
            }
        }

        require __DIR__ . '/../views/recipes/create.php';
    }

    // Update
    public function edit(int $id): void
    {
        $this->requireLogin();

        $recipe = $this->recipeModel->getById($id);

        if (!$recipe) {
            $this->setFlash('error', 'Recette introuvable.');
            $this->redirect('recipes');
        }

        // Seul l'auteur peut modifier sa recette
        if ((int) $recipe['user_id'] !== (int) $_SESSION['user_id']) {
            $this->setFlash('error', 'Action non autorisée.');
            $this->redirect('recipes');
        }

        //$categories = $this->categoryModel->getAll();
        $errors     = [];
        $data       = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeInput($_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                $this->recipeModel->update($id, $data);

                $this->setFlash('success', 'Recette mise à jour !');
                $this->redirect('recipes');
            }
        }

        require __DIR__ . '/../views/recipes/edit.php';
    }

    // Delete
    public function delete(int $id): void
    {
        $this->requireLogin();

        // La suppression doit venir d'un formulaire POST, jamais d'un lien GET
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('recipes');
        }

        $recipe = $this->recipeModel->getById($id);

        if (!$recipe) {
            $this->setFlash('error', 'Recette introuvable.');
            $this->redirect('recipes');
        }

        if ((int) $recipe['user_id'] !== (int) $_SESSION['user_id']) {
            $this->setFlash('error', 'Action non autorisée.');
            $this->redirect('recipes');
        }

        $this->recipeModel->delete($id);
        $this->setFlash('success', 'Recette supprimée.');
        $this->redirect('recipes');
    }

    /* Nettoie les données POST */
    private function sanitizeInput(array $post): array
    {
        return [
            'title'        => trim($post['title']        ?? ''),
            'ingredients'  => trim($post['ingredients']  ?? ''),
            'instructions' => trim($post['instructions'] ?? ''),
            'prep_time'    => (int) ($post['prep_time']  ?? 0),
            'cook_time'    => (int) ($post['cook_time']  ?? 0),
            'portions'     => (int) ($post['portions']   ?? 4),
            'category_id'  => !empty($post['category_id']) ? (int) $post['category_id'] : null,
        ];
    }

    /* Retourne un tableau d'erreurs (vide = tout est ok) */
    private function validate(array $data): array
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors[] = 'Le titre est obligatoire.';
        }
        if (empty($data['ingredients'])) {
            $errors[] = 'Les ingrédients sont obligatoires.';
        }
        if (empty($data['instructions'])) {
            $errors[] = 'Les instructions sont obligatoires.';
        }
        if ($data['prep_time'] <= 0) {
            $errors[] = 'Le temps de préparation doit être supérieur à 0.';
        }

        return $errors;
    }

    /* Stocke un message flash en session */
    private function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type'    => $type,   // 'success' | 'error'
            'message' => $message,
        ];
    }

    /* Redirige vers une page du projet */
    private function redirect(string $page): never
    {
        header("Location: index.php?page={$page}");
        exit;
    }

    /* Redirige vers login si l'utilisateur n'est pas connecté */
    private function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->setFlash('error', 'Connectez-vous pour continuer.');
            header('Location: index.php?page=login');
            exit;
        }
    }
}