<?php

class User 
{

    private int $id;
    private string $alias;
    private string $lastName;
    private string $firstName;
    private string $email;
    private int $isAdmin;
    private float $balance;
    private int $hp;
    private int $dexterite;
    private int $poidsMax;
    
    public function __construct(int $id, string $alias, string $lastName, string $firstName, string $email, int $isAdmin, float $balance, int $hp, int $dexterite, int $poidsMax) {
        $this->id = $id;
        $this->alias = $alias;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
        $this->balance = $balance;
        $this->hp = $hp;
        $this->dexterite = $dexterite;
        $this->poidsMax = $poidsMax;
    }

    // Getters
    public function getId(): int {
        return $this->id;
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
    public function getIsAdmin(): int {
        return $this->isAdmin;
    }
    public function getBalance(): float {
        return $this->balance;
    }
    public function getDexterite(): int {
        return $this->dexterite;
    }
    public function getPoidsMax(): int {
        return $this->poidsMax;
    }
    public function getHp(): int {
        return $this->hp;
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
    public function setBalance(float $balance): void {
        $this->balance = $balance;
    }
    public function setHp(int $hp): void {
        if($hp < 0) {
            $hp = 0;
        }
        $this->hp = $hp;
    }
    public function setDexterite(int $dexterite): void {
        $this->dexterite = $dexterite;
    }
    public function setPoidsMax(int $poidsMax): void {
        $this->poidsMax = $poidsMax;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'alias' => $this->alias,
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'email' => $this->email,
            'isAdmin' => $this->isAdmin,
            'balance' => $this->balance,
            'hp' => $this->hp,
            'dexterite' => $this->dexterite,
            'poidsMax' => $this->poidsMax
        ];
    }
    public function isAdmin(): bool {
        return $this->isAdmin === 1;
    }
} 