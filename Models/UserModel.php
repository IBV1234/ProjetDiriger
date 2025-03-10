<?php

require_once 'src/class/ModelInterface.php';
require_once 'src/class/User.php';

class UserModel implements ModelInterface
{

    // La propriété pourrait être déclarée hors constructeur
    // private PDO $pdo

    // Ici la propriété $pdo est déclarée dans le constructeur directement
    public function __construct(private PDO $pdo) {}
    
    public function selectAll() : null|array {
        
        $users = [];

        try{

            // $this->pdo-> car $pdo est une propriété de l'objet
            $stm = $this->pdo->prepare('SELECT id, alias, nom, prenom, courriel, isadmin, password, solde, hp FROM usagers');
    
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {

                foreach ($data as $row) {

                    $users[] = new User(
                        $row['id'],
                        $row['alias'],
                        $row['nom'],
                        $row['prenom'],
                        $row['courriel'],
                        $row['password'],
                        $row['isadmin'],
                        $row['solde'],
                        $row['hp']
                        );

                }

                return $users;

            }
            
            return null;
            
        } catch (PDOException $e) {
    
            throw new PDOException($e->getMessage(), $e->getCode());
            
        }

    }

    public function selectById(int $id) : null|User {

        try{
            $stm = $this->pdo->prepare('SELECT id, alias, nom, prenom, courriel, isadmin, password, solde, hp FROM usagers WHERE id=:id');
    
            $stm->bindValue(":id", $id, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {

                return new User(
                    $data['id'],
                    $data['alias'],
                    $data['nom'],
                    $data['prenom'],
                    $data['courriel'],
                    $data['password'],
                    $data['isadmin'],
                    $data['solde'],
                    $data['hp']
                    );

            }
            
            return null;
            
        } catch (PDOException $e) {
    
            throw new PDOException($e->getMessage(), $e->getCode());
            
        }  

    }

}

