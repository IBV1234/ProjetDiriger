<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'models/UserModel.php';

sessionStart();

////////////////////////////////////////
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$userModel = new UserModel($pdo);
$user = $_SESSION['user'];
$user = $userModel->selectById($user->getId());

require 'views/account.php';
