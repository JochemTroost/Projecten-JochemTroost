<?php
namespace App\Models;

use InvalidArgumentException;
use PDO;

class Employee
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private string $role
    ) {}

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getRole(): string { return $this->role; }

    public static function validate(array $data): array
    {
        $errors = [];
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $role = trim($data['role'] ?? 'medewerker');

        if ($name === '') $errors['name'] = 'Naam is verplicht';
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Ongeldig e-mailadres';
        if (!in_array($role, ['medewerker','beheerder'], true)) $errors['role'] = 'Ongeldige rol';

        return $errors;
    }

    public static function all(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM employees ORDER BY name');
        $rows = $stmt->fetchAll();
        return array_map(fn($r) => new self((int)$r['id'], $r['name'], $r['email'], $r['role']), $rows);
    }

    public static function find(int $id): ?self
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM employees WHERE id = ?');
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        return $r ? new self((int)$r['id'], $r['name'], $r['email'], $r['role']) : null;
    }

    public static function create(array $data): self
    {
        $errors = self::validate($data);
        if ($errors) throw new InvalidArgumentException(json_encode($errors, JSON_UNESCAPED_UNICODE));

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO employees (name, email, role) VALUES (?,?,?)');
        $stmt->execute([
            trim($data['name']), trim($data['email']), trim($data['role'] ?? 'medewerker')
        ]);
        return self::find((int)$pdo->lastInsertId());
    }

    public function update(array $data): self
    {
        $errors = self::validate($data);
        if ($errors) throw new InvalidArgumentException(json_encode($errors, JSON_UNESCAPED_UNICODE));

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE employees SET name=?, email=?, role=? WHERE id=?');
        $stmt->execute([
            trim($data['name']), trim($data['email']), trim($data['role']), $this->id
        ]);
        return self::find($this->id);
    }

    public function delete(): void
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM employees WHERE id=?');
        $stmt->execute([$this->id]);
    }
}