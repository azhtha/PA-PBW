<?php
namespace App\Core;

abstract class Model {
    protected $table;
    protected $primaryKey = 'id';
    protected $db;
    protected $fillable = [];
    protected $data = [];

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function create(array $data) {
        $filtered = array_intersect_key($data, array_flip($this->fillable));
        $columns = implode(', ', array_keys($filtered));
        $placeholders = implode(', ', array_fill(0, count($filtered), '?'));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

        $this->db->query($sql, array_values($filtered));
        return $this->db->lastInsertId();
    }

    public function update($id, array $data) {
        $filtered = array_intersect_key($data, array_flip($this->fillable));
        $sets = implode(', ', array_map(fn($key) => "{$key} = ?", array_keys($filtered)));

        $sql = "UPDATE {$this->table} SET {$sets} WHERE {$this->primaryKey} = ?";
        $values = array_merge(array_values($filtered), [$id]);

        return $this->db->query($sql, $values)->affectedRows() > 0;
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->query($sql, [$id])->affectedRows() > 0;
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->query($sql, [$id])->first();
    }

    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->query($sql)->get();
    }

    public function where($column, $operator, $value = null) {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?";
        return $this->db->query($sql, [$value])->get();
    }
}