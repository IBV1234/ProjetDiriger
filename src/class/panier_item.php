<?php
class PanierItem {
    private ?int $joueurs_idJoueurs;

    private ?int $items_idItem;
    private int $quantitePanier;


    public function __construct(
        int $joueurs_idJoueurs,
        int $items_idItem,
        ?int $quantitePanier,

    ) {
        $this->joueurs_idJoueurs = $joueurs_idJoueurs;
        $this->items_idItem = $items_idItem;
        $this->quantitePanier = $quantitePanier;

    }

    // Getters
    public function getIdJoueur(): ?int {
        return $this->joueurs_idJoueurs;
    }

    public function getQuantite(): string {
        return $this->quantitePanier;
    }
    public function getIdItem(): ?int {
        return $this->items_idItem;
    }

  

}
