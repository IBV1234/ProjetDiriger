<?php
require_once 'src/class/Achat.php';

 class HistoriqueAchatsModel 
 {
    public function __construct(private PDO $pdo) {}

    public function selectByItem(int $idItem,int $idJoueur): array {
        $achats =[];
        try{
            $stm = $this->pdo->prepare('SELECT id_item,id_joueur from historiqueAchats WHERE id_item =:idItem AND id_joueur = :idJoueur');
    
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);

            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {

                foreach ($data as $row) {
                    $achats[] = new Achat(
                            $row['id_joueur'],
                            $row['id_item'],


                    );
                }

                return $achats;
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
        return $achats;
    }

    public function insertAchats($_idItem,$_idJoueur){
       try{
        $stm = $this->pdo->prepare('INSERT INTO historiqueAchats (id_item,id_joueur) VALUES(:_idItem,:_idJoueur)');
    
        $stm->bindValue(":_idItem", $_idItem, PDO::PARAM_INT);
        $stm->bindValue(":_idJoueur", $_idJoueur, PDO::PARAM_INT);


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

    public function deleteAchat($idItem,$idJoueur){
        try{
            $stm = $this->pdo->prepare('DELETE FROM historiqueAchats WHERE id_joueur = :idJoueur AND id_item = :idItem');
    
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
    public function isIn($pIdJoueur,$idItem){
        try{

            $stm = $this->pdo->prepare("SELECT * FROM historiqueAchats WHERE id_item =:idItem AND id_joueur =:pIdJoueur");
            $stm->bindValue("pIdJoueur",$pIdJoueur,PDO::PARAM_INT);
            $stm->bindValue("idItem",$idItem,PDO::PARAM_INT);
    
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if(empty($result))
                return false;
            else{
                return true;
            }
    
        }catch(PDOException $e){
    
            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", 
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