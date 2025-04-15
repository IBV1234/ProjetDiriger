<?php

require_once 'src/class/reponse.php';

class ReponseModel 
{
    public function __construct(private PDO $pdo) {}
    
    public function chercherReponses($idEnigme) : null|array {
        try {
            $stm = $this->pdo->prepare('CALL fetchReponses(:idEnigme);');
            $stm->bindValue(':idEnigme', $idEnigme, PDO::PARAM_INT);
            $stm->execute();

            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
          
            if (!empty($data)) {
                $reponses = [];

                foreach ($data as $row) {
                    $reponses[] = new Reponse(
                        $row['idEnigme'],
                        $row['laReponse'],
                        $row['estBonne'],
                        $row['idReponse']
                    );
                }

                return $reponses;
            }


        } catch (PDOException $e) {

            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", // formatage 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
              );

              file_put_contents('logs/error.txt', $errorMessage, FILE_APPEND);

              redirect('views/error.php');

        }
        return null;
    }

    public function selectReponseById($idReponse): null|Reponse {
        try{
            $stm = $this->pdo->prepare('CALL chercherReponseParId(:idReponse)');
            $stm->bindValue(":idReponse", $idReponse, PDO::PARAM_INT);
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return new Reponse(
                    $data['idEnigme'],
                    $data['laReponse'],
                    $data['estBonne'],
                    $data['idReponse']
                );
            }

        } catch (PDOException $e) {
    
            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", // formatage 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
              );

              file_put_contents('logs/error.txt', $errorMessage, FILE_APPEND);

              redirect('views/error.php');

        }  
        return null;
    }

    public function nombreBonnesReponses($idJoueur): null|int {
        try{
            $stm = $this->pdo->prepare('CALL nombreDeBonneReponses(:idJoueur)');
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return $data['Count'];
            }

        } catch (PDOException $e) {
    
            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", // formatage 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
              );

              file_put_contents('logs/error.txt', $errorMessage, FILE_APPEND);

              redirect('views/error.php');

        }  
        return null;
    }

    public function nombreMauvaisesReponses($idJoueur): null|int {
        try{
            $stm = $this->pdo->prepare('CALL nombreDeMauvaisesReponses(:idJoueur)');
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return $data['Count'];
            }

        } catch (PDOException $e) {
    
            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", // formatage 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
              );

              file_put_contents('logs/error.txt', $errorMessage, FILE_APPEND);

              redirect('views/error.php');

        }  
        return null;
    }

    public function insertStatistique($idJoueur, $idEgnime, int $reussie): void {
        try{
            $stm = $this->pdo->prepare('CALL insertStat(:idJoueur, :idEnigme, :reussie)');
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->bindValue(":idEnigme", $idEgnime, PDO::PARAM_INT);
            $stm->bindValue(":reussie", $reussie, PDO::PARAM_INT);
            $stm->execute();
        } catch (PDOException $e) {
    
            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", // formatage 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
              );

              file_put_contents('logs/error.txt', $errorMessage, FILE_APPEND);

              redirect('views/error.php');

        }
    }
}

