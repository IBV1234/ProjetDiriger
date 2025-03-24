<?php
class Item {

    private ?int $idItem;
    private string $typeitem;
    private string $nom;
    private int $qtestock;
    private float $prix;
    private float $poids;
    private int $utilite;
    private string $lienphoto;
    private int $estDisponible;
    private string $description;
    private int $rating;

    public function __construct(
        ?int $idItem,
        string $typeitem,
        string $nom,
        int $qtestock,
        float $prix,
        float $poids,
        int $utilite,
        string $lienphoto,
        int $estDisponible, 
        ?string $description = '',
        ?int $rating = 0
    ) {
        $this->idItem = $idItem;
        $this->typeitem = $typeitem;
        $this->nom = $nom;
        $this->qtestock = $qtestock;
        $this->estDisponible = $estDisponible;
        $this->prix = $prix;
        $this->poids = $poids;
        $this->utilite = $utilite;
        $this->lienphoto = $lienphoto;
        $this->description = $description ?? '';
        $this->rating = $rating ?? 0;
        }

    // Getters
    public function getIdItem(): ?int {
        return $this->idItem;
    }

    public function getTypeItem(): string {
        return $this->typeitem;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getQteStock(): int {
        return $this->qtestock;
    }


    public function getPrix(): float {
        return $this->prix;
    }

    public function getPoids(): float {
        return $this->poids;
    }

    public function getUtilite(): int {
        return $this->utilite;
    }

    public function getLienPhoto(): string {
        return "public/images/" . $this->lienphoto;
    }

    public function getEstDisponible(): int {
        return $this->estDisponible;
    }
    public function getDescription(): string {
        return $this->description;
    }
    public function getRating(): int {
        return $this->rating;
    }
}