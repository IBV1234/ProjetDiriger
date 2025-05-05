<?php
class Achat {
    private int $idJoueur;

    private int $idItem;

  
    public function __construct(
        int $idJoueur,
        int $idItem,

        
    ) {
        $this->idJoueur = $idJoueur?? 0;
        $this->idItem = $idItem;
        }

    // Getters
    public function getIdJoueur(): int {
        return $this->idJoueur;
    }
    public function getIdItem(): int {
        return $this->idItem;
    }


}
