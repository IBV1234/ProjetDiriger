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

//temporary thing -- simulates puting the item in the session........
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$userModel = new UserModel($pdo);
$user = $_SESSION['user'];
$user = $userModel->selectById($user->getId());
$_SESSION['user'] = $user;

//modify password logic
if(isPost()){
    $input = json_decode(file_get_contents('php://input'), true);
    switch($input['action'] ?? null) {
        case 'updateUsername':
            $newName = $input['newUsername'] ?? null;
            if (empty($newName)) {
                echo json_encode(['success' => false, 'error' => 'Nom d\'utilisateur requis']);
                exit;
            }
            $user = $_SESSION['user'];
            try{
                $isNameChanged = $userModel->modifierNomUser($newName, $user->getId());
                if($isNameChanged)
                    echo json_encode(['success' => true]);
                else
                    echo json_encode(['success' => false, 'error' => 'Nom d\'utilisateur probablement déja utilisé.']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            exit;
        case 'updatePassword':
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
}

//MAJ de la session
$_SESSION['user'] = $userModel -> selectById($_SESSION['user']->getId());
$panierModel = new PanierModel($pdo);
$_SESSION['poidsSac'] = $panierModel->getPoidsSacDos($_SESSION['user']->getId());

require 'views/account-modify.php';