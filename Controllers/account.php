<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'Models/UserModel.php';

sessionStart();

//temporary thing -- simulates puting the item in the session........
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$userModel = new UserModel($pdo);
$user = $userModel->getUserByEmail("monsieurtesteur@gmail.com");
$_SESSION['user'] = $user;

require 'views/account.php';
