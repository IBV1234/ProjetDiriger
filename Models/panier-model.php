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
            $stm = $this->pdo->prepare('SELECT idPanier,idItem, quantite FROM Panier_item');
    
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

    public function selectById(int $idItem) : null|PanierItem { // selectionne le panier du joueur

        try{
            $stm = $this->pdo->prepare('SELECT idPanier,idItem, quantite FROM Panier_item WHERE idItem = :idItem');
    
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {

                return new PanierItem(
                    $data['idPanier'],
                    $data['idItem'],
                    $data['quantite']

                 
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
        }
    }
    
}

