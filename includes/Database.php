<?php
$host = 'localhost';
$dbname = 'tp_notes';
$user = 'root';
$pass = '';
class Database {
    public static function getConnection() {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=tp_notes', 'root', '');
            // Optionnel : mode d’erreurs
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}