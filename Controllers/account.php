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

//temporary thing -- simulates puting the item in the session........
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$userModel = new UserModel($pdo);
$user = $_SESSION['user'];

require 'views/account.php';
