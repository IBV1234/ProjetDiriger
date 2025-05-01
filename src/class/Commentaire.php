<?php
class Commentaire {
    private ?int $idJoueur;

    private string $alias;
    private int $idItem;
    private string $leCommentaire;
    private ?float $evaluation;
  
    public function __construct(
        ?int $idJoueur,
        string $alias,
        int $idItem,
        string $leCommentaire,
        ?float $evaluation = 0,
        
    ) {
        $this->idJoueur = $idJoueur?? 0;
        $this->alias = $alias;
        $this->idItem = $idItem;
        $this->leCommentaire = $leCommentaire;
        $this->evaluation = $evaluation?? 0;
        }

    // Getters
    public function getIdJoueur(): int {
        return $this->idJoueur;
    }
    public function getAlias(): string {
        return $this->alias;
    }

    public function getIdItem(): int {
        return $this->idItem;
    }

    public function getLeCommentaire(): string {
        return $this->leCommentaire;
    }

    public function getEvaluation(): int {
        return $this->evaluation;
    }


}
