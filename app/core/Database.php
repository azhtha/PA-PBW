<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    protected $pdo;
    protected $statement;
    protected $logger;

    public function __construct(array $config, Logger $logger) {
        $this->logger = $logger;
        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

            $this->pdo = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            $this->logger->error('Database connection failed: ' . $e->getMessage());
            throw new DatabaseException('Database connection error');
        }
    }

    public function query($sql, $bindings = []) {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($bindings);
        return $this;
    }

    public function get() {
        return $this->statement->fetchAll();
    }

    public function first() {
        return $this->statement->fetch();
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function affectedRows() {
        return $this->statement->rowCount();
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollback() {
        return $this->pdo->rollBack();
    }
}