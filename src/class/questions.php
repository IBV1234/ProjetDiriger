<?php
class Questions {

    private int $idEgnime;
    private string $enonce;
    private string $difficulte;
    # donner de réponse à l'énigme

    public function __construct(
        int $idEgnime,
        string $enonce,
        string $difficulte,
 
    ) {
        $this->idEgnime = $idEgnime;
        $this->enonce = $enonce;
        $this->difficulte = $difficulte;

        }

    // Getters
    public function getIdEgnime(): int {
        return $this->idEgnime;
    }

    public function getEnonce(): string {
        return $this->enonce;
    }

    public function getdifficulteInLetters(): string {
        switch($this->difficulte) {
            case 'F':
                return 'Facile';
            case 'M':
                return 'Moyenne';
            case 'D':
                return 'Difficile';
    
        }
        return 'Inconnue';
    }
    public function getdifficulte(): string {
        return $this->difficulte;
    }
    
 
}
