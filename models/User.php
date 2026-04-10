<?php
require_once __DIR__ . '/../config/Database.php';
class User
{
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

    //Getters
    public function getId():        ?int   { return $this->id; }
    public function getUsername():  string { return $this->username; }
    public function getEmail():     string { return $this->email; }
    public function getPassword():  string { return $this->password; }
    public function getCreatedAt(): string { return $this->createdAt; }

    //Setters 
    public function setUsername(string $username): void  { $this->username = $username; }
    public function setEmail(string $email): void        { $this->email    = $email; }
    public function setPassword(string $password): void  { $this->password = $password; }

    public static function register(string $username, string $email, string $password): bool
    {
        $pdo  = Database::getInstance()->getConnection();
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

            return false;
        }
    }

    public static function login(string $email, string $password): ?array
    {
        $pdo  = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $row  = $stmt->fetch();

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }

        return null;
    }
    public static function emailExists(string $email): bool
    {
        $pdo  = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return (bool) $stmt->fetchColumn();
    }
}
