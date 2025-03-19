<?php

require 'src/session.php';
require 'src/class/database.php';
require 'models/UserModel.php';

//INITIALISATION......................
sessionStart();
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$userModel = new UserModel($pdo);

if(!isset($_SESSION['error'])) $_SESSION['error'] = null;

//AFFICHAGE...........................
require 'views/inscription.php';

//TRAITEMENT..........................
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['error'] = null;

    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirmPassword = $_POST['passwordVerif'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;
    $alias = $_POST['alias'] ?? null;

    if($email && $password && $confirmPassword && $nom && $prenom && $alias){
        $user = $userModel->getUserByEmail($email); //devrait etre NULL

        //ERREURS UTILISATEURS
        if($user) $_SESSION['error'] = 'Vous avez déjà un compte. Connectez-vous !';
        if($password != $confirmPassword) $_SESSION['error'] = 'Vos mots de passe ne sont pas les mêmes.';

        //INSCRIPTION JOUEUR
        if($_SESSION['error'] == null){
            redirect('/');
        }
    }else{
        $_SESSION['error'] = 'Vous devez remplir tous les champs.';
    }

    redirect('/connexion');
}