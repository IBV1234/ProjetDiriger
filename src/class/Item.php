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
    private int $evaluation;

    public function __construct(
        ?int $idItem,
        string $nom,
        string $typeitem,
        float $poids,
        int $qtestock,
        float $prix,
        int $utilite,
        string $lienphoto,
        int $estDisponible, 
        ?string $description = '',
        ?int $evaluation = 0
    ) {
        $this->idItem = $idItem;
        $this->nom = $nom;
        $this->typeitem = $typeitem;
        $this->poids = $poids;
        $this->qtestock = $qtestock;
        $this->estDisponible = $estDisponible;
        $this->prix = $prix;
        $this->utilite = $utilite;
        $this->lienphoto = $lienphoto;
        $this->description = $description ?? '';
        $this->evaluation = $evaluation ?? 0;
        }

    // Getters
    public function getIdItem(): ?int {
        return $this->idItem;
    }

    public function getType(): string {
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
    public function getEvaluation(): int {
        return $this->evaluation;
    }
}

