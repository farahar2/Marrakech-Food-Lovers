<?php

require_once __DIR__ . '/../config/Database.php';

class Recipe
{
    // ── Propriétés (colonnes de la table) ──────────────────────────────────
    private int    $id;
    private string $title;
    private string $ingredients;
    private string $instructions;
    private int    $prep_time;
    private int    $cook_time;
    private int    $portions;
    private int    $user_id;
    private ?int   $category_id;

    // ── Connexion partagée ─────────────────────────────────────────────────
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // ══════════════════════════════════════════════════════════════════════
    //  CRUD
    // ══════════════════════════════════════════════════════════════════════

    /**
     * Toutes les recettes (avec nom auteur + catégorie).
     */
    public function getAll(): array
    {
        $sql = "SELECT r.*, u.username, c.name AS category_name
                FROM recipes r
                JOIN users      u ON u.id = r.user_id
                LEFT JOIN categories c ON c.id = r.category_id
                ORDER BY r.created_at DESC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Une seule recette par son id.
     */
    public function getById(int $id): array|false
    {
        $sql = "SELECT r.*, u.username, c.name AS category_name
                FROM recipes r
                JOIN users      u ON u.id = r.user_id
                LEFT JOIN categories c ON c.id = r.category_id
                WHERE r.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Recettes d'un utilisateur précis.
     */
    public function getByUser(int $user_id): array
    {
        $sql = "SELECT r.*, c.name AS category_name
                FROM recipes r
                LEFT JOIN categories c ON c.id = r.category_id
                WHERE r.user_id = :user_id
                ORDER BY r.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Créer une recette. Retourne l'id inséré.
     */
    public function create(array $data): int
    {
        $sql = "INSERT INTO recipes
                    (title, ingredients, instructions, prep_time, cook_time, portions, user_id, category_id)
                VALUES
                    (:title, :ingredients, :instructions, :prep_time, :cook_time, :portions, :user_id, :category_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title'        => $data['title'],
            ':ingredients'  => $data['ingredients'],
            ':instructions' => $data['instructions'],
            ':prep_time'    => (int) $data['prep_time'],
            ':cook_time'    => (int) ($data['cook_time'] ?? 0),
            ':portions'     => (int) ($data['portions']  ?? 4),
            ':user_id'      => (int) $data['user_id'],
            ':category_id'  => !empty($data['category_id']) ? (int) $data['category_id'] : null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Modifier une recette. Retourne true si au moins 1 ligne modifiée.
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE recipes SET
                    title        = :title,
                    ingredients  = :ingredients,
                    instructions = :instructions,
                    prep_time    = :prep_time,
                    cook_time    = :cook_time,
                    portions     = :portions,
                    category_id  = :category_id
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title'        => $data['title'],
            ':ingredients'  => $data['ingredients'],
            ':instructions' => $data['instructions'],
            ':prep_time'    => (int) $data['prep_time'],
            ':cook_time'    => (int) ($data['cook_time'] ?? 0),
            ':portions'     => (int) ($data['portions']  ?? 4),
            ':category_id'  => !empty($data['category_id']) ? (int) $data['category_id'] : null,
            ':id'           => $id,
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Supprimer une recette. Retourne true si supprimée.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM recipes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }
}