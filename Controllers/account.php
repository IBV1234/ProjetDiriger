<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'Models/UserModel.php';

sessionStart();

////////////////////////////////////////
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

//temporary thing -- simulates puting the item in the session........
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$userModel = new UserModel($pdo);
$_SESSION['user'] = $user;

require 'views/account.php';
