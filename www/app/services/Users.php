<?php

namespace App\Services;

use App\Models\User;
use PDO;

class Users
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createUser(string $email, string $password, int $locationId): int
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, password_hash, location_id) VALUES (:email, :password_hash, :location_id)');
        $stmt->execute([
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'location_id' => $locationId
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $data ? $this->getUser($data) : null;
    }

    public function getUserByEmailAndPassword(string $email, string $password): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email AND password_hash = :password_hash');
        $stmt->execute(['email' => $email, 'password_hash' => $password]); // FIXME
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $data ? $this->getUser($data) : null;
    }    

    public function getUserById(int $id): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->getUser($data) : null;
    }

    private function getUser(array $data): User
    {
        return new User(
            $data['id'],
            $data['email'],
            $data['location_id']
        );
    }
}
