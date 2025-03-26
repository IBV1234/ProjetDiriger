<?php

require_once 'src/class/ModelInterface.php';
require_once 'src/class/User.php';

class UserModel implements ModelInterface
{

    // La propriété pourrait être déclarée hors constructeur
    // private PDO $pdo;

    // Ici la propriété $pdo est déclarée dans le constructeur directement
    public function __construct(private PDO $pdo) {}
    
    public function selectAll() : null|array {
        
        $users = [];

        try{

            // $this->pdo-> car $pdo est une propriété de l'objet
            $stm = $this->pdo->prepare('SELECT idJoueur, alias, nom, prenom, courriel, estAdmin, motDePasse, capital, pointDeVie, dexterite, poidMax FROM joueurs');
    
            $stm->execute();
    
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);

            if (! empty($data)) {

                foreach ($data as $row) {

                    $users[] = new User(
                        $data['idJoueur'],
                        $data['alias'],
                        $data['nom'],
                        $data['prenom'],
                        $data['courriel'],
                        $data['estAdmin'],
                        $data['capital'],
                        $data['pointDeVie'],
                        $data['dexterite'],
                        $data['poidMax']
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
            $stm = $this->pdo->prepare('SELECT idJoueur, alias, nom, prenom, courriel, estAdmin, capital, pointDeVie, dexterite, poidMax FROM joueurs WHERE idJoueur=:id');
    
            $stm->bindValue(":id", $id, PDO::PARAM_INT);
            
            $stm->execute();
    
            $data = $stm->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {

                return new User(
                    $data['idJoueur'],
                    $data['alias'],
                    $data['nom'],
                    $data['prenom'],
                    $data['courriel'],
                    $data['estAdmin'],
                    $data['capital'],
                    $data['pointDeVie'],
                    $data['dexterite'],
                    $data['poidMax']
                    );

            }
            
            return null;
            
        } catch (PDOException $e) {
    
            throw new PDOException($e->getMessage(), $e->getCode());
            
        }  

    }

    public function getUserByEmail(string $email): null|User {
        try{
            $user = $this->pdo->prepare('CALL chercherJoueurParCourriel(:email)');
            $user->bindValue(":email", $email, PDO::PARAM_STR);
            $user->execute();
    
            $data = $user->fetch(PDO::FETCH_ASSOC);

            if(! empty($data)) {
                return new User(
                    $data['idJoueur'],
                    $data['alias'],
                    $data['nom'],
                    $data['prenom'],
                    $email,
                    $data['estAdmin'],
                    $data['capital'],
                    $data['pointDeVie'],
                    $data['dexterite'],
                    $data['poidMax']
                );
            }
            return null;
            
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }  
    }

    public function verifyPasswordUser(string $password, string $email): bool {
        try{
            $match = $this->pdo->prepare('SELECT verificationMotDePasse(:password, :email)');
            $match->bindValue(":email", $email, PDO::PARAM_STR);
            $match->bindValue(":password", $password, PDO::PARAM_STR);
            $match->execute();

            $data = $match->fetch(PDO::FETCH_NUM);
            if($data[0] == 1) 
                return true;
            return false;

        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
    public function modifierPasswordUser(string $nouvPassword, user $user): bool{
        try{
            $stm = $this->pdo->prepare('CALL modifierPasswordUser(:userId, :newPassword, @success)');
            $stm->bindValue(":userId", $user->getId(), PDO::PARAM_INT);
            $stm->bindValue(":newPassword", $nouvPassword, PDO::PARAM_STR);
            $stm->execute();

            $result = $this->pdo->query('SELECT @success')->fetch(PDO::FETCH_NUM);
            return $result[0] == 1;
        } catch (PDOException $e){
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
}

