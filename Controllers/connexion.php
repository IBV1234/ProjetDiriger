<?php

require 'src/session.php';
require 'src/class/database.php';
require 'models/UserModel.php';

//INITIALISATION......................
sessionStart();
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$userModel = new UserModel($pdo);
$rememberMeDays = 30;

if(!isset($_SESSION['error'])) $_SESSION['error'] = null;

//AFFICHAGE...........................
require 'views/connexion.php';

//TRAITEMENT..........................
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['error'] = null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $remember = isset($_POST['remember']) ? true : false;

    if($email && $password){
        $user = $userModel->getUserByEmail($email);

        if($user && $userModel->verifyPasswordUser($password, $email)){
            $_SESSION['user'] = $user;
            if($remember){
                setcookie('user', $user->getId(), time() + (3600 * 24 * $rememberMeDays), '/');
            }
            redirect('/');
        }
    }
    (empty($email) || empty($password)) ? $_SESSION['error'] = 'Veuillez remplir tous les champs.' : $_SESSION['error'] = 'Courriel ou mot de passe invalide.';
}

/*
NOTES PERSONNELLES:
    - Ajouter les identifiants de l'usager dans la page connexion (remember)
    - erreur session ne part pas quand on change de page (ex: index)
*/