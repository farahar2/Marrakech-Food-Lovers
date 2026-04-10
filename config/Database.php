<?php
class Database {
    public PDO $pdo;

    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $db   = "MaraFood";

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                $this->user,
                $this->pass
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo"connected";
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection error. Please try again later.");
        }
    }
}

$db = new Database();

// Use directly
$stmt = $db->pdo->query("SELECT * FROM users");

?>