<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}

if(!isset($_SESSION['bonus'])){
    $_SESSION['bonus'] = 0;
}
///////////////////////////////////////

//MAJ de la session
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$panierModel = new PanierModel($pdo);
$_SESSION['poidsSac'] = $panierModel->getPoidsSacDos($_SESSION['user']->getId());
$userModel = new UserModel($pdo);
$_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());

require 'views/index-enigma.php';