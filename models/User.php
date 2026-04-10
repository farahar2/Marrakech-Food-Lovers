<?php

/**
 * Modèle User
 * Encapsule les données et la logique métier liées aux utilisateurs.
 */
class User
{
    // ── Propriétés privées (encapsulation) ───────────────────
    private ?int    $id;
    private string  $username;
    private string  $email;
    private string  $password;
    private string  $createdAt;

    public function __construct(
        string $username  = '',
        string $email     = '',
        string $password  = '',
        ?int   $id        = null,
        string $createdAt = ''
    ) {
        $this->id        = $id;
        $this->username  = $username;
        $this->email     = $email;
        $this->password  = $password;
        $this->createdAt = $createdAt;
    }

    // ── Getters ───────────────────────────────────────────────
    public function getId():        ?int   { return $this->id; }
    public function getUsername():  string { return $this->username; }
    public function getEmail():     string { return $this->email; }
    public function getPassword():  string { return $this->password; }
    public function getCreatedAt(): string { return $this->createdAt; }

    // ── Setters ───────────────────────────────────────────────
    public function setUsername(string $username): void  { $this->username = $username; }
    public function setEmail(string $email): void        { $this->email    = $email; }
    public function setPassword(string $password): void  { $this->password = $password; }

    // ── Méthodes statiques (accès base de données) ────────────

    /**
     * Inscrit un nouvel utilisateur.
     * Retourne true en cas de succès, false si l'email existe déjà.
     */
    public static function register(string $username, string $email, string $password): bool
    {
        $pdo  = Database::getInstance();
        $hash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare(
                'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)'
            );
            return $stmt->execute([
                ':username' => $username,
                ':email'    => $email,
                ':password' => $hash,
            ]);
        } catch (PDOException $e) {
            // Code 23000 = violation de contrainte d'unicité
            return false;
        }
    }

    /**
     * Authentifie un utilisateur par email + mot de passe.
     * Retourne un tableau associatif ou null.
     */
    public static function login(string $email, string $password): ?array
    {
        $pdo  = Database::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $row  = $stmt->fetch();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }

        return null;
    }

    /**
     * Vérifie si un email est déjà utilisé.
     */
    public static function emailExists(string $email): bool
    {
        $pdo  = Database::getInstance();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return (bool) $stmt->fetchColumn();
    }
}
