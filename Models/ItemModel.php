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
        
        $items = [];

        try {

            // $this->pdo-> car $pdo est une propriété de l'objet
            $stm = $this->pdo->prepare('CALL ItemsGetAll()');

            $stm->execute();

            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
          
            if (! empty($data)) {

                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['typeItem'],
                        $row['nomItem'],
                        $row['qteStock'],
                        $row['prix'],
                        $row['poids'],
                        $row['utilite'],
                        $row['lienphoto'],
                        $row['flagDispo'],
                        $row['descriptionItem'] ?? '',
                        $row['evaluation'] ?? 0
                    );
                }

                return $items;
            }

            return null;

        } catch (PDOException $e) {

            throw new PDOException($e->getMessage(), $e->getCode());

        }
    }

    public function selectActive() : null|array {
        
        $items = [];

        try{

            // $this->pdo-> car $pdo est une propriété de l'objet
            $stm = $this->pdo->prepare('CALL ItemsGetActive()');
    
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {
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
                        $row['descriptionItem'] ?? '',
                        $row['evaluation'] ?? 0
                    );
                }

                return $items;
            }

            return null;

        } catch (PDOException $e) {

            throw new PDOException($e->getMessage(), $e->getCode());
            
        }
    }

    public function selectByType(int $type) : null|array {

        $items = [];

        try{
            $stm = $this->pdo->prepare('CALL ItemsGetByType(:type)');
    
            $stm->bindValue(":type", $type, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if (! empty($data)) {
                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['typeItem'],
                        $row['nomItem'],
                        $row['qteStock'],
                        $row['prix'],
                        $row['poids'],
                        $row['utilite'],
                        $row['lienphoto'],
                        $row['flagDispo'],
                        $row['descriptionItem'] ?? '',
                        $row['evaluation'] ?? 0
                    );
                }

                return $items;
            }
            
            return null;
            
        } catch (PDOException $e) {
    
            throw new PDOException($e->getMessage(), $e->getCode());
            
        }  

    }

    public function selectActiveByType(int $type) : null|array {

        $items = [];

        try{
            $stm = $this->pdo->prepare('CALL ItemsGetActiveByType(:type)');
    
            $stm->bindValue(":type", $type, PDO::PARAM_INT);
            
            $stm->execute();

            $data = $stm->fetch(PDO::FETCH_ASSOC);
          
            if (! empty($data)) {
                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['typeItem'],
                        $row['nomItem'],
                        $row['qteStock'],
                        $row['prix'],
                        $row['poids'],
                        $row['utilite'],
                        $row['lienphoto'],
                        $row['flagDispo'],
                        $row['descriptionItem'] ?? '',
                        $row['evaluation'] ?? 0
                    );
                }

                return $items;
            }
            
            return null;
            
        } catch (PDOException $e) {
    
            throw new PDOException($e->getMessage(), $e->getCode());
            
        }  

    }
    
    public function selectById(int $id): null {
        //dummy function to avoid error of not implementing the interface
        return null;
    }
    /*
    public function insert(Item $item) : void {
        try {
            $stm = $this->pdo->prepare("CALL ajouterItem(:nomItem,:typeitem, :poids, :quantiteStock :prix, :utilite, :photo, :flagDispo ,:descriptionItem)");
    
            $stm->bindValue(":typeitem", $item->getTypeItem(), PDO::PARAM_STR);
            $stm->bindValue(":nom", $item->getNom(), PDO::PARAM_STR);
            $stm->bindValue(":qtestock", $item->getQteStock(), PDO::PARAM_INT);
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
    }*/

  
    
}

