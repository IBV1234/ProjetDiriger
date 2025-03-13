<?php

require_once 'src/class/ModelInterface.php';
require_once 'src/class/Joueur.php';

class JoueurModel implements ModelInterface
{

    // La propriété pourrait être déclarée hors constructeur
    // private PDO $pdo

    // Ici la propriété $pdo est déclarée dans le constructeur directement
    public function __construct(private PDO $pdo){}

    public function selectAll(): null|array
    {

        $Joueur = [];

        try {

            // $stm = $this->pdo->prepare('SELECT Id, alias, nom, prenom, courriel, isAdmin, password, solde, ptsVie FROM Joueurs');
            $stm = $this->pdo->prepare('SELECT * FROM Joueurs');

            $stm->execute();

            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {

                foreach ($data as $row) {

                    $Joueur[] = new Joueur(
                        $row['Id'],
                        $row['alias'],
                        $row['nom'],
                        $row['prenom'],
                        $row['courriel'],
                        $row['password'],
                        $row['isAdmin']??0,
                        $row['solde'],
                        $row['ptsVie']
                    );

                }

                return $Joueur;

            }


        } catch (PDOException $e) {

            // throw new PDOException($e->getMessage(), $e->getCode());
            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", // formatage 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }
        return null;
    }

    public function selectById(int $id): null|Joueur
    {

        try {
            $stm = $this->pdo->prepare('SELECT Id, alias, nom, prenom, courriel, isAdmin, password, solde, ptsVie FROM Joueurs WHERE Id=:Id');

            $stm->bindValue(":Id", $id, PDO::PARAM_INT);

            $stm->execute();

            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {

                return new Joueur(
                    $data['id'],
                    $data['alias'],
                    $data['nom'],
                    $data['prenom'],
                    $data['courriel'],
                    $data['password'],
                    $data['isadmin'],
                    $data['solde'],
                    $data['hp']
                );

            }

            return null;

        } catch (PDOException $e) {

            // throw new PDOException($e->getMessage(), $e->getCode());
            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", // formatage 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
        }

    }

}

