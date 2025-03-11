<?php
class PanierItem {
    private ?int $idPanier;

    private ?int $idItem;
    private int $quantite;


    public function __construct(
        int $idItem,
        int $quantite,
        ?int $idPanier,

    ) {
        $this->idItem = $idItem;
        $this->quantite = $quantite;
        $this->idPanier = $idPanier;

    }

    // Getters
    public function getIdItem(): ?int {
        return $this->idItem;
    }

    public function getQuantite(): string {
        return $this->quantite;
    }
    public function getIdPanier(): ?int {
        return $this->idPanier;
    }

  

}
