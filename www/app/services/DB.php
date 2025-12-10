<?php

namespace App\Services;

use PDO;

class DB extends PDO
{
    static $instance = null;
    private function __construct(array $config)
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['dbname'],
            $config['charset']
        );

        parent::__construct($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public static function getInstance(): self
    {        
        if (self::$instance === null) {
            $config = [
                'host' => $_ENV['DB_HOST'] ?? 'database',
                'port' => (int)($_ENV['DB_PORT'] ?? 3306),
                'dbname' => $_ENV['DB_NAME'] ?? 'gratis_code_challenge',
                'username' => $_ENV['DB_USER'] ?? 'root',
                'password' => $_ENV['MYSQL_ROOT_PASSWORD'] ?? '',
                'charset' => 'utf8mb4',
            ];
            self::$instance = new self($config);
        }
        return self::$instance;
    }
}