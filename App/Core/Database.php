<?php
namespace App\Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private static $instance = null;

    private function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../config');
        $dotenv->load();
        if (!isset($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS'])) {
            die("Error: .env 文件未正确加载，请检查配置！");
        }
    
    }

    public static function getConnection() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASS']
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("数据库连接失败: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
