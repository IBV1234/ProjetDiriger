<?php

require_once 'src/class/ModelInterface.php';
require_once 'src/class/panier_item.php';
require_once 'src/class/Item.php';

class PanierModel implements ModelInterface
{
    public function __construct(private PDO $pdo) {}
    
    public function selectAll() : null|array {// selectionne tous les items et leur quantite du panier
        
        $PanierItem = [];

        try{

            // $this->pdo-> car $pdo est une propriété de l'objet
            $stm = $this->pdo->prepare('SELECT joueurs_idJoueur,items_idItem, quantitePanier FROM lePanier');
    
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {

                foreach ($data as $row) {

                    $PanierItem[] = new PanierItem(
                        $row['joueurs_idJoueur'],
                        $row['items_idItem'],
                        $row['quantitePanier'],
                        );

                }

                return $PanierItem;

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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
            
        }
        return null;
    }

    public function selectById(int $idJoueur) : null|PanierItem { // selectionne le panier du joueur

        try{
            $stm = $this->pdo->prepare('SELECT joueurs_idJoueurs,items_idItem, quantitePanier FROM lePanier WHERE joueurs_idJoueurs = :joueurs_idJoueurs');
    
            $stm->bindValue(":idItem", $idJoueur, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {

                return new PanierItem(
                    $data['idPanier'],
                    $data['idItem'],
                    $data['quantite']

                 
                    );

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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }  
        return null;
    }
  
    public function deleteItemPanier(int $pidItem,int $pIdJoueur){
        try{
            $stm = $this->pdo->prepare("DELETE FROM lePanier WHERE items_idItem = :pidItem AND joueurs_idJoueur = :pIdJoueur");
            $stm->bindValue(":pidItem",$pidItem,PDO::PARAM_INT);
            $stm->bindValue("pIdJoueur",$pIdJoueur,PDO::PARAM_INT);
            $stm->execute();


        }catch(PDOException $e){

            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
              );

              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }

    public function deleteAllItemPanier(int $pIdJoueur){
        try{
            $stm = $this->pdo->prepare("DELETE FROM lePanier WHERE  joueurs_idJoueur = :pIdJoueur");
            $stm->bindValue("pIdJoueur",$pIdJoueur,PDO::PARAM_INT);
            $stm->execute();


        }catch(PDOException $e){

            $errorMessage = sprintf(
                "Exception ERROR : %s | Code : %s | Message : %s | Fichier : %s | Ligne : %d\n", 
                date('Y-m-d H:i:s'),
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
              );

              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }

    public function selectAllInerJoin($idJoueur)
    {
        $items = [];
        try {

            $stm = $this->pdo->prepare('CALL selectAll(:idJoueur)');
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);

            $stm->execute();

            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($data)) {

                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['typeItem'],
                        $row['nomItem'],
                        $row['quantiteStock'],
                        $row['prix'],
                        $row['poids'],
                        $row['utilite'],
                        $row['photo'],
                        $row['flagDispo'],
                        $row['descriptionItem']??'',
                        $row['evaluation']??0
                    );
                }



            }
            return !empty($items) ? $items : null;


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

            file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);

            redirect('Views/error.php');

        }
        

    }

    public function insert(int $idItem,int $quantite,int $idJoueur) : void {
        try {
            $stm = $this->pdo->prepare("CALL ajouterPanier(:idItem, :quantite,:idJoueur)");
    
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            $stm->bindValue(":quantite", $quantite, PDO::PARAM_INT);
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
            
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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }

    public function insertSacADos($idJoueur) : void {
        try {
            $stm = $this->pdo->prepare("CALL majInventaire(:idJoueur)");

            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
            
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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }

    public function getPoidsSacDos($idJoueur) : ?int {
        try {
            $stm = $this->pdo->prepare("SELECT getPoidsSacADos(:idJoueur) AS poids"); 
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
            
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            
            if (!empty($result) && isset($result['poids'])) {
                return (int) $result['poids']; 
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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }

    public function getPoidsPanier($idJoueur) : ?int {
        try {
            $stm = $this->pdo->prepare("SELECT getPoidsPanier(:idJoueur) AS poidsPanier"); 
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
            
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            
            if (!empty($result) && isset($result['poidsPanier'])) {
                return (int) $result['poidsPanier']; 
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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }

    public function getPrixPanier($idJoueur) : ?int {
        try {
            $stm = $this->pdo->prepare("SELECT getPrixPanier(:idJoueur) AS prixTotal"); 
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
            
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if (!empty($result) && isset($result['prixTotal'])) {
                return (int) $result['prixTotal']; 
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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }

    public function UtiliteInSac($idJoueur) : ?int {
        try {
            $stm = $this->pdo->prepare("SELECT UtiliteInSac(:idJoueur) AS utiliteInSac"); 
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
            
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            
            if (!empty($result) && isset($result['utiliteInSac'])) {
                return (int) $result['utiliteInSac']; 
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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);
    
              redirect('Views/error.php');
        }
    }
    public function isItemInPanier($idJoueur, $idItem) : bool {
        try {
            $stm = $this->pdo->prepare("CALL itemDansPanier(:idJoueur, :idItem)"); 
            $stm->bindValue(":idJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            $stm->execute();
            
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            
            if (!empty($result) && isset($result['items_idItem'])) {
                return true;
            }
    
            return false;

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
              file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);

              redirect('Views/error.php');
        }
        return false;
    }
}
