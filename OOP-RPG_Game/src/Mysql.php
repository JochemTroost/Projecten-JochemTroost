<?php

namespace Game;

use Exception;
use PDO;
use PDOException;

/**
 * Mysql database implementatie
 */
class Mysql implements Database
{
    private PDO $connection;

    public function __construct(string $host, string $database, string $username, string $password)
    {
        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$database;charset=utf8mb4",
                $username,
                $password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function testConnection(): bool
    {
        try {
            $this->connection->query("SELECT 1");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function insert(string $table, array $data): int
    {
        try {
            $columns = array_keys($data);
            $placeholders = array_map(fn($col) => ":" . $col, $columns);

            $sql = sprintf(
                "INSERT INTO %s (%s) VALUES (%s)",
                $table,
                implode(", ", $columns),
                implode(", ", $placeholders)
            );

            $stmt = $this->connection->prepare($sql);

            foreach ($data as $col => $value) {
                $stmt->bindValue(":" . $col, $value);
            }

            $stmt->execute();
            return (int)$this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Insert query failed: " . $e->getMessage());
        }
    }

    public function select(array $tableColumns, array $conditions = []): array
    {
        try {
            $selectParts = [];
            foreach ($tableColumns as $table => $columns) {
                foreach ($columns as $col) {
                    $selectParts[] = $col === '*' ? "{$table}.*" : "{$table}.{$col}";
                }
            }

            $columnsString = implode(', ', $selectParts);
            $tablesString = implode(', ', array_keys($tableColumns));
            $sql = "SELECT {$columnsString} FROM {$tablesString}";

            $whereParts = [];
            $params = [];
            $placeholderCounter = 0;

            foreach ($conditions as $key => $value) {
                $operator = '=';
                $column = $key;

                if (preg_match('/\s*(>=|<=|<>|!=|=|<|>|LIKE|BETWEEN)\s*$/i', $key, $matches)) {
                    $operator = strtoupper($matches[1]);
                    $column = trim(str_ireplace($matches[1], '', $key));
                }

                if (is_string($value) && preg_match('/^[\w]+\.[\w]+$/', $value) && $operator === '=') {
                    $whereParts[] = "{$column} = {$value}";
                    continue;
                }

                $placeholder = ":param{$placeholderCounter}";
                $placeholderCounter++;

                switch ($operator) {
                    case 'LIKE':
                        $whereParts[] = "{$column} LIKE {$placeholder}";
                        $params[$placeholder] = "%{$value}%";
                        break;
                    case 'BETWEEN':
                        if (!is_array($value) || count($value) !== 2) {
                            throw new Exception("BETWEEN requires 2 values");
                        }
                        $placeholder1 = "{$placeholder}_1";
                        $placeholder2 = "{$placeholder}_2";
                        $whereParts[] = "{$column} BETWEEN {$placeholder1} AND {$placeholder2}";
                        $params[$placeholder1] = $value[0];
                        $params[$placeholder2] = $value[1];
                        break;
                    default:
                        $whereParts[] = "{$column} {$operator} {$placeholder}";
                        $params[$placeholder] = $value;
                }
            }

            if (!empty($whereParts)) {
                $sql .= ' WHERE ' . implode(' AND ', $whereParts);
            }

            $stmt = $this->connection->prepare($sql);

            foreach ($params as $ph => $val) {
                $stmt->bindValue($ph, $val);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Select query failed: " . $e->getMessage());
        }
    }

    public function update(string $table, array $data, array $conditions): int
    {
        try {
            if (!isset($conditions['id'])) {
                throw new Exception("UPDATE query requires an 'id' in conditions.");
            }

            $setParts = [];
            $params = [];
            $counter = 0;

            foreach ($data as $column => $value) {
                $placeholder = ":set_param{$counter}";
                $setParts[] = "{$column} = {$placeholder}";
                $params[$placeholder] = $value;
                $counter++;
            }

            $setClause = implode(', ', $setParts);
            $whereClause = "id = :where_id";
            $params[':where_id'] = $conditions['id'];

            $sql = "UPDATE {$table} SET {$setClause} WHERE {$whereClause}";

            $stmt = $this->connection->prepare($sql);

            foreach ($params as $ph => $val) {
                $stmt->bindValue($ph, $val);
            }

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Update query failed: " . $e->getMessage());
        }
    }

    public function delete(string $table, array $conditions): int
    {
        try {
            if (!isset($conditions['id'])) {
                throw new Exception("DELETE query requires an 'id' in conditions.");
            }

            $sql = "DELETE FROM {$table} WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $conditions['id']);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Delete query failed: " . $e->getMessage());
        }
    }

    public function getLastInsertId(): int
    {
        return (int)$this->connection->lastInsertId();
    }
}
