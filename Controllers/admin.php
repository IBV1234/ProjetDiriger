<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';
require 'models/historiqueAchatsModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
if($_SESSION['user']->getIsAdmin() == 0){
    redirect("/connexion");
}
///////////////////////////////////////

//1) allez chercher les utilisateurs dans la base de données
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$userModel = new UserModel($pdo);
$users = $userModel->selectAll();
$users = array_filter($users, function($user) {
    return $user->getIsAdmin() == 0; // Filtrer les utilisateurs qui ne sont pas administrateurs
});

//2) ajouter les caps
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'] ?? null;
    $userId = (int)$userId;
    $adminId = $_SESSION['user']->getId();

    if ($userId && $adminId) {
        $userModel->adminAddCaps($userId, $adminId);
        redirect('/admin');
    } else {
        redirect('/admin');
    }
}


///////////////////////////////////////
$panierModel = new PanierModel($pdo);
$sumPanier = $panierModel->SumPanier($_SESSION['user']->getId());
///////////////////////////////////////

require 'views/admin.php';