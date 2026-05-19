<?php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = parse_ini_file('config.ini', true);
        
        $host = $config['database']['host'];
        $dbname = $config['database']['dbname'];
        $user = $config['database']['user'];
        $password = $config['database']['password'];
        $port = $config['database']['port'];

        try {
            $this->connection = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
