<?php

require 'src/session.php';
require 'src/class/Database.php';
require 'models/UserModel.php';

//INITIALISATION......................
sessionStart();
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$userModel = new UserModel($pdo);
$rememberMeDays = 30;
$isRemembered = isset($_COOKIE['user']);

if (!isset($_SESSION['error']))
    $_SESSION['error'] = null;
if ($isRemembered)
    $email = $userModel->selectById((int) $_COOKIE['user'])->getEmail();

//TRAITEMENT..........................
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['error'] = null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $remember = isset($_POST['rememberBox']) ? true : false;

   
    if ($email && $password) {
        $user = $userModel->getUserByEmail($email);
             if ($user && $userModel->verifyPasswordUser($password, $email)) {
                $_SESSION['user'] = $user;

         

                if ($remember) {
                    setcookie('user', $user->getId(), time() + (3600 * 24 * $rememberMeDays), '/');
                } else {
                    setcookie("user", "", time() - 3600, "/");
                }
                redirect('/');
                
            } 

    }



    (empty($email) || empty($password)) ? $_SESSION['error'] = 'Veuillez remplir tous les champs.' : $_SESSION['error'] = 'Courriel ou mot de passe invalide.';
    redirect('/connexion');
}
//AFFICHAGE...........................
require 'views/connexion.php';