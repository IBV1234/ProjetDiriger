<?php
class Reponse {

    private int $idEgnime;
    private string $reponse;
    private bool $estBonne;
    private int $idReponse;
    
    public function __construct(
        int $idEgnime,
        string $reponse,
        bool $estBonne,
        int $idReponse = null
    ) {
        $this->idEgnime = $idEgnime;
        $this->reponse = $reponse;
        $this->estBonne = $estBonne;
        $this->idReponse = $idReponse;
 
    }

    // Getters
    public function getIdEgnime(): int {
        return $this->idEgnime;
    }

    public function getReponse(): string {
        return $this->reponse;
    }

    public function getEstBonne(): bool {
        return $this->estBonne;
    }

    public function getIdReponse(): int {
        return $this->idReponse;
    }
}
