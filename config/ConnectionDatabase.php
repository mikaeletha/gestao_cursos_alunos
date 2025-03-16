<?php

class ConnectionDatabase
{
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $host = 'localhost';
        $dbname = 'alura_fiap';
        $user = 'root';
        $password = '';

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->connection = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception("Database connection failed.");
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
?>
