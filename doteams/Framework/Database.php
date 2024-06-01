<?php

namespace Framework;

use PDO;
use PDOException;
use Exception;

class Database {
    public $connection;

    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try{
            $this->connection = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e){
            throw new Exception("Database connection failed {$e->getMessage()}");
        }
    }

    public function sql($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);

            foreach($params as $param => $value){
                $stmt->bindValue(':' . $param, $value);
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e){
            throw new Exception("SQL statement execution failed {$e->getMessage()}");
        }
    }
}