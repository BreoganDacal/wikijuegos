<?php
require_once("config.php");

class Database {
    private $pdo;

    public function connect() {
        if (!$this->pdo) {
            try {
                $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
?>
