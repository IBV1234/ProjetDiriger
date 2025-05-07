<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

sessionStart();

////////////////////////////////////////
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$userModel = new UserModel($pdo);
$_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
$user = $_SESSION['user'];

//MAJ de la session
$panierModel = new PanierModel($pdo);
$_SESSION['poidsSac'] = $panierModel->getPoidsSacDos($_SESSION['user']->getId());

require 'views/account.php';
