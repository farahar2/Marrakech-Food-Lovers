<?php
class Database {
    private static ?PDO $instance = null;

    // Empêche l'instanciation directe
    private function __construct() {}

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                // En prod : logger l'erreur, ne jamais l'afficher
                die('Connexion échouée. Contactez l\'administrateur.');
            }   
        }
        return self::$instance;
    }
}