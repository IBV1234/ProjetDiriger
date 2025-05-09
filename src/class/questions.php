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
                return 'facile';
            case 'M':
                return 'moyenne';
            case 'D':
                return 'difficile';
    
        }
        return 'Inconnue';
    }
    public function getdifficulte(): string {
        return $this->difficulte;
    }

    public function getCaps(): int {
        $caps = null;
        switch($this->getDifficulte()) {
            case 'F':
                $caps = 50;
                break;
            case 'M':
                $caps = 100;
                break;
            case 'D':
                $caps = 200;
                break;
        }
        return $caps;
    }

    public function getBonus(): int {
        return 1000;
    }

    public function getPerteDeVie(): int {
        $difficulte = $this->getDifficulte();
        switch($difficulte) {
            case 'F':
                return 3;
            case 'M':
                return 6;
            case 'D':
                return 10;
        }
        return 0;
    }

}
