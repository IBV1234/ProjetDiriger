<?php
class Egnime {

    private ?int $idEgnime;
    private string $enonce;
    private string $difficulte;
    private int $esPigee;
    # donner de réponse à l'énigme
    private ?int $idReponse;

    private string $laReponse;
    private string $estBonne;

    public function __construct(
        ?int $idEgnime,
        string $enonce,
        string $difficulte,
        int $esPigee,
        ?int $idReponse,
        string $laReponse,
        string $estBonne
    ) {
        $this->idEgnime = $idEgnime;
        $this->enonce = $enonce;
        $this->difficulte = $difficulte;
        $this->esPigee = $esPigee;
        $this->$idReponse = $idReponse;
        $this-> $laReponse = $laReponse;
        $this-> $estBonne = $estBonne;
        }

    // Getters
    public function getIdEgnime(): ?int {
        return $this->idEgnime;
    }

    public function getEnonce(): string {
        return $this->enonce;
    }

    public function getdifficulte(): string {
        return $this->difficulte;
    }

    public function getEsPigee(): int {
        return $this->esPigee;
    }
    
    # getters pour les réponses
    public function getidReponse(): int {
        return $this->esPigee;
    }
    
    public function getLaReponse(): string {
        return $this->laReponse;
    }
    public function getEstBonne(): string {
        return $this->estBonne;
    }
}
