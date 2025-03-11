<?php

class User 
{

    private int $idItem;
    private string $alias;
    private string $lastName;
    private string $firstName;
    private string $email;
    private string $password;
    private int $isAdmin;
    private float $balance;
    private int $hp;
    
    public function __construct(int $id, string $alias, string $lastName, string $firstName, string $email, string $password, int $isAdmin, float $balance, int $hp) {
        $this->idItem = $id;
        $this->alias = $alias;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
        $this->balance = $balance;
        $this->hp = $hp;
    }

    // Getters
    public function getId(): int {
        return $this->idItem;
    }
    public function getAlias(): string {
        return $this->alias;
    }
    public function getLastName(): string {
        return $this->lastName;
    }
    public function getFirstName(): string {
        return $this->firstName;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function getIsAdmin(): int {
        return $this->isAdmin;
    }
    public function getBalance(): float {
        return $this->balance;
    }

    // Setters
    public function setAlias(string $alias): void {
        $this->alias = $alias;
    }
    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }
    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }
    public function setEmail(string $email): void {
        $this->$email = $email;
    }
    public function setPassword(string $password): void {
        $this->$password = $password;
    }
    public function setBalance(float $balance): void {
        $this->balance = $balance;
    }
    public function setHp(int $hp): void {
        $this->hp = $hp;
    }
    public function toArray(): array {
        return [
            'id' => $this->idItem,
            'alias' => $this->alias,
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'email' => $this->email,
            'password' => $this->password,
            'isAdmin' => $this->isAdmin,
            'balance' => $this->balance,
            'hp' => $this->hp
        ];
    }
} 