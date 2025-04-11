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
}

