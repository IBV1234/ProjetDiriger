<?php

require_once 'src/class/Questions.php';

class QuestionsModel 
{


    public function __construct(private PDO $pdo) {}

    public function select_question_reponses($idJoueur) : null|Questions {
        try {
            $stm = $this->pdo->prepare('CALL ChercherQuestionsAleatoires(:idJoueur)');
            $stm->bindValue(':idJoueur', $idJoueur, PDO::PARAM_INT);
            $stm->execute();

            $data = $stm->fetch(PDO::FETCH_ASSOC);
          
            if (!empty($data)) {
                return new Questions(
                    $data['idEnigme'],
                    $data['enonce'],
                    $data['difficulte']
                );
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

    public function chercherQuestionSelonDifficulte($idJoueur, $difficulty) : null|Questions {
        try {
            $stm = $this->pdo->prepare('CALL Chercher_Questions_Aleatoires_Selon_laDiffculter(:idJoueur, :difficulte)');
            $stm->bindValue(':idJoueur', $idJoueur, PDO::PARAM_INT);
            $stm->bindValue(':difficulte', $difficulty, PDO::PARAM_STR);
            $stm->execute();

            $data = $stm->fetch(PDO::FETCH_ASSOC);
          
            if (!empty($data)) {
                return new Questions(
                    $data['idEnigme'],
                    $data['enonce'],
                    $data['difficulte']
                );
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
            $stm = $this->pdo->prepare('CALL chercherEnigmeParId(:idEgnime)');
    
            $stm->bindValue(":idEgnime", $idEgnime, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return new Questions(
                        $data['idEnigme'],
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

