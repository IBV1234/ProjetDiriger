<?php
class Commentaire {

    private string $alias;
    private int $idItem;
    private string $leCommentaire;
    private ?float $evaluation;
  
    public function __construct(
        string $alias,
        int $idItem,
        string $leCommentaire,
        ?float $evaluation = 0,
        
    ) {
        $this->alias = $alias;
        $this->idItem = $idItem;
        $this->leCommentaire = $leCommentaire;
        $this->evaluation = $evaluation?? 0;
        }

    // Getters
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
