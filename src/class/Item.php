<?php
class Item {
    

    private int $idItem;
    private string $nomItem;
    private string $typeItem;
    private int $poids;
    private int $qteStock;
    private int $prix;
    private int $utilite;
    private string $lienphoto;
    private int $flagDispo;
    private string|null $descriptionItem;
    private float|null $rating;

    public function __construct(int $idItem, string $typeItem, string $nomItem, int $qteStock, int $prix, int $poids, int $utilite, string $lienphoto, int $flagDispo, string|null $descriptionItem, float|null $rating) {
        $this->idItem = $idItem;
        $this->typeItem = $typeItem;
        $this->nomItem = $nomItem;
        $this->qteStock = $qteStock;
        $this->prix = $prix;
        $this->poids = $poids;
        $this->utilite = $utilite;
        $this->lienphoto = $lienphoto;
        $this->flagDispo = $flagDispo;
        $this->descriptionItem = $descriptionItem;
        $this->rating = $rating;
    }

    // Getters
    public function getId(): int {
        return $this->idItem;
    }
    public function getNom(): string {
        return $this->nomItem;
    }
    public function getType(): string {
        return $this->typeItem;
    }
    public function getPoids(): int {
        return $this->poids;
    }
    public function getQteStock(): int {
        return $this->qteStock;
    }
    public function getPrix(): int {
        return $this->prix;
    }
    public function getUtilite(): int {
        return $this->utilite;
    }
    public function getLienPhoto(): string {

        return "public/images/" . $this->lienphoto;
      

    }
    public function getFlagDispo(): int {
        return $this->flagDispo;
    }
    public function getDescription(): string|null {
        return $this->descriptionItem;
    }
    public function getRating(): float {
        if ($this->rating !== null) {
            return round($this->rating, 1);
        }
        return 0;
    }

    //Fonction spécifique
    public function estDisponible(): bool {
        return $this->flagDispo === 1;
    }

    public function toArray(): array {
        return [
            'idItem' => $this->idItem,
            'typeItem' => $this->typeItem,
            'nomItem' => $this->nomItem,
            'qteStock' => $this->qteStock,
            'prix' => $this->prix,
            'poids' => $this->poids,
            'utilite' => $this->utilite,
            'lienphoto' => $this->lienphoto,
            'flagDispo' => $this->flagDispo,
            'descriptionItem' => $this->descriptionItem,
            'rating' => $this->rating
        ];
    }
}
