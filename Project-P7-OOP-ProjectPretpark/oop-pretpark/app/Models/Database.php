<?php
namespace App\Models;

use PDO;
use PDOException;
class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $host = 'localhost';
            $db = 'projectpretpark';
            $user = 'root';
            $pass = '';
            $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $error) {
                die('Database connection failed: ' . $error->getMessage());
            }
        }
        return self::$instance;
    }
}