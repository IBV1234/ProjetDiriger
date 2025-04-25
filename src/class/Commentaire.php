<?php
class Commentaire {

    private int $idJoueur;
    private string $idItem;
    private string $leCommentaire;
    private ?float $evaluation;
  
    public function __construct(
        int $idJoueur,
        string $idItem,
        string $leCommentaire,
        ?float $evaluation = 0,
        
    ) {
        $this->idJoueur = $idJoueur;
        $this->idItem = $idItem;
        $this->leCommentaire = $leCommentaire;
        $this->evaluation = $evaluation?? 0;
        }

    // Getters
    public function getIdJoueur(): ?int {
        return $this->idJoueur;
    }

    public function getIdItem(): string {
        return $this->idItem;
    }

    public function getLeCommentaire(): string {
        return $this->leCommentaire;
    }

    public function getEvaluation(): int {
        return $this->evaluation;
    }


}
