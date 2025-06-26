<?php

class User {
    private ?int $id = null;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $username;
    private string $password;
    private int $roleId;
    private string $createdAt;
    private ?UserRole $role = null;

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getFirstName(): string { return $this->firstName; }
    public function setFirstName(string $firstName): void { $this->firstName = $firstName; }

    public function getLastName(): string { return $this->lastName; }
    public function setLastName(string $lastName): void { $this->lastName = $lastName; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }

    public function getUsername(): string { return $this->username; }
    public function setUsername(string $username): void { $this->username = $username; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): void { $this->password = $password; }

    public function getRoleId(): int { return $this->roleId; }
    public function setRoleId(int $roleId): void { $this->roleId = $roleId; }

    public function getCreatedAt(): string { return $this->createdAt; }
    public function setCreatedAt(string $createdAt): void { $this->createdAt = $createdAt; }

    public function getRole(): ?UserRole { return $this->role; }
    public function setRole(UserRole $role): void { $this->role = $role; }
}