<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'Models/UserModel.php';

//temporary thing -- simulates puting the item in the session........
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$userModel = new UserModel($pdo);
$user = $userModel->getUserByEmail("monsieurtesteur@gmail.com");
$_SESSION['user'] = $user;

//modify password logic
if(isPost()){
    $input = json_decode(file_get_contents('php://input'), true);
    $newPassword = $input['newPassword'] ?? null;
    if (empty($newPassword)) {
        echo json_encode(['success' => false, 'error' => 'Password is required.']);
        exit;
    }
    $user = $_SESSION['user'];
    $isPasswordChanged = $userModel->modifierPasswordUser($newPassword, $user);
    if($isPasswordChanged)
        echo json_encode(['success' => true]);
    else
        echo json_encode(['success' => false, 'error' => 'Failed to change password']);
}

require 'views/account-modify.php';