<?php
require_once 'src/class/Commentaire.php';

 class CommentaireModel 
 {
    public function __construct(private PDO $pdo) {}

    public function selectByItem(int $idItem): array {
        $commentaires =[];
        try{
            $stm = $this->pdo->prepare('CALL CommentairesParItem(:idItem)');
    
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {

                foreach ($data as $row) {
                    $commentaires[] = new Commentaire(
                            $row['idJoueur'],
                            $row['alias'],
                            $row['idItem'],
                            $row['leCommentaire'],
                            $row['evaluation'],

                    );
                }

                return $commentaires;
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
        return $commentaires;
    }

    public function insertCommentaire($_idItem,$_idJoueur,$_leCommentaire,$_evaluation){
       try{
        $stm = $this->pdo->prepare('CALL InsererUnCommentaire(:_idItem,:_idJoueur,:_leCommentaire,:_evaluation)');
    
        $stm->bindValue(":_idItem", $_idItem, PDO::PARAM_INT);
        $stm->bindValue(":_idJoueur", $_idJoueur, PDO::PARAM_INT);
        $stm->bindValue(":_leCommentaire", $_leCommentaire, PDO::PARAM_STR);
        $stm->bindValue(":_evaluation", $_evaluation, PDO::PARAM_INT);

        $stm->execute();
       }catch(PDOException $e){

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

    public function deleteComment($idItem,$idJoueur){
        try{
            $stm = $this->pdo->prepare('DELETE FROM commentaires WHERE idJoueur = :idJoueur AND idItem = :idItem');
    
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();

        }catch(PDOException $e){
            
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