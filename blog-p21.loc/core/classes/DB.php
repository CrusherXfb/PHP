<?php

class DB
{
    private $conn;
    private PDOStatement $stmt;
    public function __construct(array $db_config)
    {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        try {
            $this->conn = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
            //echo "DB {$db_config['dbname']} connection";
        } catch (PDOException $e) {
            //echo "DB ERROR: {$e->getMessage()}";
            abort(500);
        }
    }

    public function query($query, $params = [])
    {
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }

    public function findAll() {
        return $this->stmt->fetchAll();
    }

    public function find() {
        return $this->stmt->fetch();
    }

    public function findOrAbort() {
        $res = $this->find();
        if (!$res) {
            abort(500);
        }
        return $res;
    }
}

