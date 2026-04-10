<?php

require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';

class RecipeController
{
    private Recipe   $recipeModel;
    //private Category $categoryModel;

    public function __construct()
    {
        $this->recipeModel   = new Recipe();
        //$this->categoryModel = new Category();
    }

    // ══════════════════════════════════════════════════════════════════════
    //  LISTE  –  GET /recipes
    // ══════════════════════════════════════════════════════════════════════
    public function index(): void
    {
        $recipes = $this->recipeModel->getAll();
        require __DIR__ . '/../views/recipes/index.php';
    }

    // ══════════════════════════════════════════════════════════════════════
    //  DÉTAIL  –  GET /recipes?action=show&id=X
    // ══════════════════════════════════════════════════════════════════════
    public function show(int $id): void
    {
        $recipe = $this->recipeModel->getById($id);

        if (!$recipe) {
            $this->redirect('recipes', 'Recette introuvable.');
        }

        require __DIR__ . '/../views/recipes/show.php';
    }

    // ══════════════════════════════════════════════════════════════════════
    //  CRÉATION  –  GET affiche le form / POST enregistre
    // ══════════════════════════════════════════════════════════════════════
    public function create(): void
    {
        //$this->requireLogin();
        //$categories = $this->categoryModel->getAll();
        $errors     = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeInput($_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                $data['user_id'] = $_SESSION['user_id'];
                $this->recipeModel->create($data);
                $this->redirect('recipes', 'Recette créée avec succès !');
            }
        }

        require __DIR__ . '/../views/recipes/create.php';
    }

    // ══════════════════════════════════════════════════════════════════════
    //  MODIFICATION  –  GET affiche le form / POST enregistre
    // ══════════════════════════════════════════════════════════════════════
    public function edit(int $id): void
    {
        //$this->requireLogin();

        $recipe = $this->recipeModel->getById($id);

        if (!$recipe) {
            $this->redirect('recipes', 'Recette introuvable.');
        }

        // Seul l'auteur peut modifier
        if ($recipe['user_id'] !== $_SESSION['user_id']) {
            $this->redirect('recipes', 'Action non autorisée.');
        }

        //$categories = $this->categoryModel->getAll();
        $errors     = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeInput($_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                $this->recipeModel->update($id, $data);
                $this->redirect('recipes', 'Recette mise à jour !');
            }
        }

        require __DIR__ . '/../views/recipes/edit.php';
    }

    // ══════════════════════════════════════════════════════════════════════
    //  SUPPRESSION  –  POST /recipes?action=delete&id=X
    // ══════════════════════════════════════════════════════════════════════
    public function delete(int $id): void
    {
        //$this->requireLogin();

        $recipe = $this->recipeModel->getById($id);

        if (!$recipe) {
            $this->redirect('recipes', 'Recette introuvable.');
        }

        if ($recipe['user_id'] !== $_SESSION['user_id']) {
            $this->redirect('recipes', 'Action non autorisée.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->recipeModel->delete($id);
            $this->redirect('recipes', 'Recette supprimée.');
        }

        // Si GET accidentel → retour liste
        $this->redirect('recipes');
    }

    // ══════════════════════════════════════════════════════════════════════
    //  Helpers privés
    // ══════════════════════════════════════════════════════════════════════

    /** Nettoie les données POST */
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

    /** Règles de validation simples */
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

    /** Redirige avec un message flash optionnel */
    private function redirect(string $page, string $flash = ''): never
    {
        if ($flash) {
            $_SESSION['flash'] = $flash;
        }
        header("Location: index.php?page={$page}");
        exit;
    }

    /** Redirige vers login si pas connecté */
    // private function requireLogin(): void
    // {
    //     if (empty($_SESSION['user_id'])) {
    //         header('Location: index.php?page=login');
    //         exit;
    //     }
    // }
}