<?php

require_once 'src/class/questions.php';

class QuestionsModel 
{


    public function __construct(private PDO $pdo) {}

    public function select_question_reponses() : null|array {
        
        $questions = [];

        try {
            $stm = $this->pdo->prepare('CALL ChercherQuestionsAleatoires()');# à compléter avec la procédure SQL  qui doit être créé par Sabrina

            $stm->execute();

            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
          
            if (! empty($data)) {

                foreach ($data as $row) {
                    $questions[] = new Questions(
                        $row['idEnigme'],
                        $row['enonce'],
                        $row['difficulte'],
   
                    );
                }

                return $questions;
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

    
    public function selectEgnimeById(int $idEgnime): null|Questions {
        try{
            $stm = $this->pdo->prepare('CALL IdEgnimeetById(:idEgnime)');# à compléter avec la procédure SQL  qui doit être créé par Sabrina
    
            $stm->bindValue(":idEgnime", $idEgnime, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return new Questions(
                        $data['idEgnime'],
                        $data['enonce'],
                        $data['difficulte'],
                    
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

