<?php

require_once 'src/class/ModelInterface.php';
require_once 'src/class/Item.php';

class ItemModel implements ModelInterface
{

    // La propriété pourrait être déclarée hors constructeur
    // private PDO $pdo

    // Ici la propriété $pdo est déclarée dans le constructeur directement
    public function __construct(private PDO $pdo) {}
    
    public function selectAll() : null|array {
        
        $Item = [];

        try{

            // $this->pdo-> car $pdo est une propriété de l'objet
            $stm = $this->pdo->prepare('SELECT idItem, typeitem, nom, qtestock, description, prix, poids, utilite, lienphoto,estDisponible FROM Items');
    
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {

                foreach ($data as $row) {

                    $Item[] = new Item(
                        $row['idItem'],
                        $row['typeitem'],
                        $row['nom'],
                        $row['qtestock'],
                        $row['description'],
                        $row['prix'],
                        $row['poids'],
                        $row['utilite'],
                        $row['lienphoto'],
                        $row['estDisponible']
                        );

                }

                return $Item;

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

    public function selectById(int $idItem) : null|Item {

        try{
            $stm = $this->pdo->prepare('SELECT idItem, typeitem, nom, qtestock, description, prix, poids, utilite, lienimage,estDisponible FROM Items WHERE idItem = :idItem');
    
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {

                return new Item(
                    $data['idItem'],
                    $data['typeitem'],
                    $data['nom'],
                    $data['qtestock'],
                    $data['description'],
                    $data['prix'],
                    $data['poids'],
                    $data['utilite'],
                    $data['lienimage'],
                    $data['estDisponible']
                    );

                    file_put_contents('Logs/error.txt', $errorMessage, FILE_APPEND);

                    redirect('Views/error.php');

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
    public function insert(Item $item) : void {
        try {
            $stm = $this->pdo->prepare("CALL ajouterItem(:typeitem, :nom, :qtestock, :description, :prix, :poids, :utilite, :lienphoto, :estDisponible)");
    
            $stm->bindValue(":typeitem", $item->getTypeItem(), PDO::PARAM_STR);
            $stm->bindValue(":nom", $item->getNom(), PDO::PARAM_STR);
            $stm->bindValue(":qtestock", $item->getQteStock(), PDO::PARAM_INT);
            $stm->bindValue(":description", $item->getDescription(), PDO::PARAM_STR);
            $stm->bindValue(":prix", $item->getPrix(), PDO::PARAM_INT);
            $stm->bindValue(":poids", $item->getPoids(), PDO::PARAM_INT);
            $stm->bindValue(":utilite", $item->getUtilite(), PDO::PARAM_INT);
            $stm->bindValue(":lienphoto", $item->getLienPhoto(), PDO::PARAM_STR);
            $stm->bindValue(":estDisponible", $item->getEstDisponible(), PDO::PARAM_INT);
    
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
    
}

