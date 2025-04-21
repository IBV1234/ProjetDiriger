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
            $stm = $this->pdo->prepare('CALL ItemsGetAll()');

            $stm->execute();

            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
          
            if (! empty($data)) {

                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['nomItem'],
                        $row['typeItem'],
                        $row['poids'],
                        $row['quantiteStock'],
                        $row['prix'],
                        $row['utilite'],
                        $row['photo'],
                        $row['flagDispo'],
                        $row['descriptionItem'],
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
                        $row['nomItem'],
                        $row['typeItem'],
                        $row['poids'],
                        $row['quantiteStock'],
                        $row['prix'],
                        $row['utilite'],
                        $row['photo'],
                        $row['flagDispo'],
                        $row['descriptionItem'],
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
    
    public function selectById(int $idItem): null|Item {
        try{
            $stm = $this->pdo->prepare('CALL ItemGetById(:idItem)');
    
            $stm->bindValue(":idItem", $idItem, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return new Item(
                    $data['idItem'],
                    $data['nomItem'],
                    $data['typeItem'],
                    $data['poids'],
                    $data['quantiteStock'],
                    $data['prix'],
                    $data['utilite'],
                    $data['photo'],
                    $data['flagDispo'],
                    $data['descriptionItem'],
                    $data['evaluation'] ?? 0
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

              file_put_contents('logs/error.txt', $errorMessage, FILE_APPEND);

              redirect('views/error.php');

        }  
        return null;
    }

    public function selectByInventory(int $idJoueur) : null|array {
        
        $items = [];

        try{
            $stm = $this->pdo->prepare('CALL ItemsDansInventaire(:idDuJoueur)');
            $stm->bindValue(":idDuJoueur", $idJoueur, PDO::PARAM_INT);
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {
                foreach ($data as $row) {
                    $items[] = new Item(
                        $row['idItem'],
                        $row['nomItem'],
                        $row['typeItem'],
                        $row['poids'],
                        $row['quantite'],
                        $row['prix']??0,
                        $row['utilite']??0,
                        $row['photo'],
                        $row['flagDispo']??0,
                        $row['descriptionItem']??'',
                        $row['evaluation']??0
                    );
                }
                return $items;
            }

            return null;

        } catch (PDOException $e) {

            throw new PDOException($e->getMessage(), $e->getCode());
            
        }
    }    
}