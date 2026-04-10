<?php

require_once __DIR__ . '/../config/Database.php';

class Recipe
{
    private PDO $pdo;

    public function __construct()
    {
        $db        = new Database();
        $this->pdo = $db->pdo;
    }

    /* Toutes les recettes avec auteur + catégorie */
    public function getAll(): array
    {
        $stmt = $this->pdo->query(
            "SELECT r.*, u.username, c.name AS category_name
             FROM   recipes r
             JOIN   users      u ON u.id = r.user_id
             LEFT JOIN categories c ON c.id = r.category_id
             ORDER  BY r.created_at DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Une recette par son id */
    public function getById(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT r.*, u.username, c.name AS category_name
             FROM   recipes r
             JOIN   users      u ON u.id = r.user_id
             LEFT JOIN categories c ON c.id = r.category_id
             WHERE  r.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* Recettes d'un utilisateur précis */
    public function getByUser(int $user_id): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT r.*, c.name AS category_name
             FROM   recipes r
             LEFT JOIN categories c ON c.id = r.category_id
             WHERE  r.user_id = :user_id
             ORDER  BY r.created_at DESC"
        );
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Insère une recette et retourne son id */
    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO recipes
                (title, ingredients, instructions, prep_time, cook_time, portions, user_id, category_id)
             VALUES
                (:title, :ingredients, :instructions, :prep_time, :cook_time, :portions, :user_id, :category_id)"
        );
        $stmt->execute([
            ':title'        => $data['title'],
            ':ingredients'  => $data['ingredients'],
            ':instructions' => $data['instructions'],
            ':prep_time'    => (int) $data['prep_time'],
            ':cook_time'    => (int) ($data['cook_time']   ?? 0),
            ':portions'     => (int) ($data['portions']    ?? 4),
            ':user_id'      => (int) $data['user_id'],
            ':category_id'  => !empty($data['category_id']) ? (int) $data['category_id'] : null,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /* Modifie une recette, retourne true si une ligne a changé */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE recipes SET
                title        = :title,
                ingredients  = :ingredients,
                instructions = :instructions,
                prep_time    = :prep_time,
                cook_time    = :cook_time,
                portions     = :portions,
                category_id  = :category_id
             WHERE id = :id"
        );
        $stmt->execute([
            ':title'        => $data['title'],
            ':ingredients'  => $data['ingredients'],
            ':instructions' => $data['instructions'],
            ':prep_time'    => (int) $data['prep_time'],
            ':cook_time'    => (int) ($data['cook_time']  ?? 0),
            ':portions'     => (int) ($data['portions']   ?? 4),
            ':category_id'  => !empty($data['category_id']) ? (int) $data['category_id'] : null,
            ':id'           => $id,
        ]);
        return $stmt->rowCount() > 0;
    }

    /* Supprime une recette, retourne true si supprimée */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM recipes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }
}