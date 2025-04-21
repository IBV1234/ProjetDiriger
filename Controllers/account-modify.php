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

//modify password logic
if(isPost()){
    $input = json_decode(file_get_contents('php://input'), true);
    $newPassword = $input['newPassword'] ?? null;
    if (empty($newPassword)) {
        echo json_encode(['success' => false, 'error' => 'Mot de passe requis']);
        exit;
    }
    $user = $_SESSION['user'];
    try{
        $isPasswordChanged = $userModel->modifierPasswordUser($newPassword, $user);
        if($isPasswordChanged)
            echo json_encode(['success' => true]);
        else
            echo json_encode(['success' => false, 'error' => 'La modification du mot de passe a subit une erreur, veuillez resayer']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

require 'views/account-modify.php';