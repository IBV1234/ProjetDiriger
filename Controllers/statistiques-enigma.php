<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/User.php';
require 'models/ReponseModel.php';

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

require 'views/statistiques-enigma.php';