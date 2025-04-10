<?php

require_once 'src/class/egnimes.php';

class EgnimeModel 
{


    public function __construct(private PDO $pdo) {}

    public function select_question_reponses() : null|array {
        
        $egnimes = [];

        try {
            $stm = $this->pdo->prepare('CALL select_question_reponses()');# à compléter avec la procédure SQL  qui doit être créé par Sabrina

            $stm->execute();

            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
          
            if (! empty($data)) {

                foreach ($data as $row) {
                    $egnimes[] = new Egnime(
                        $row['idEgnime'],
                        $row['enonce'],
                        $row['difficulte'],
                        $row['esPigee'],
                        $row['idReponse'],
                        $row['laReponse'],
                        $row['estBonne'],
                    );
                }

                return $egnimes;
            }

            return null;

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

    
    public function selectEgnimeById(int $idEgnime): null|Egnime {
        try{
            $stm = $this->pdo->prepare('CALL IdEgnimeetById(:idEgnime)');# à compléter avec la procédure SQL  qui doit être créé par Sabrina
    
            $stm->bindValue(":idEgnime", $idEgnime, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return new Egnime(
                        $data['idEgnime'],
                        $data['enonce'],
                        $data['difficulte'],
                        $data['esPigee'],
                        $data['idReponse'],
                        $data['laReponse'],
                        $data['estBonne'],
                    
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

}

