<?php

class Database
{

    private static $instance;
    private $conn;

    // Le constructeur est privé
    // pour éviter la création hors de la classe
    private function __construct(array $dbConfig, array $dbParams) {
        
        try {

            // conn va contenir l'objet PDO
            $this->conn = new PDO("mysql:host=".$dbConfig["hostname"].";port=".$dbConfig["port"].";dbname=".$dbConfig["database"], $dbConfig["username"], $dbConfig["password"], $dbParams);
          
        } catch(PDOException $e) {
            
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

    // Fonction statique car nous n'appellons
    // pas le constructeur directement
    public static function getInstance(array $dbConfig, array $dbParams) : Database {

        if( is_null(self::$instance) ) {

            // La variable statique contiendra l'instance de Database
            // C'est ici que le constructeur est appelé
            self::$instance = new Database($dbConfig, $dbParams);

        }

        // Retourne la variable statique, donc toujours le même objet
        return self::$instance;
    }

    public function getPDO() : PDO {

        // Retourne l'objet PDO 
        return $this->conn;

    }


}