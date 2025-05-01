<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'models/ReponseModel.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$reponseModel = new ReponseModel($pdo);

$mauvaisesReponses = $reponseModel->nombreMauvaisesReponses($_SESSION['user']->getId());
$bonnesReponses = $reponseModel->nombreBonnesReponses($_SESSION['user']->getId());

//MAJ de la session
$_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
$_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

require 'views/statistiques-enigma.php';