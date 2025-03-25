<?php

require_once 'src/class/ModelInterface.php';
require_once 'src/class/panier_item.php';

class PanierModel implements ModelInterface
{
    public function __construct(private PDO $pdo) {}
    
    public function selectAll() : null|array {// selectionne tous les items et leur quantite du panier
        
        $PanierItem = [];

        try{

            // $this->pdo-> car $pdo est une propriété de l'objet
            $stm = $this->pdo->prepare('SELECT joueurs_idJoueurs,items_idItem, quantitePanier FROM lePanier');
    
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {

                foreach ($data as $row) {

                    $PanierItem[] = new PanierItem(
                        $row['idPanier'],
                        $row['idItem'],
                        $row['quantite'],
                     
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

    public function getPoids($idJoueur) : ?int {
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
        return null;
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