<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';
require 'models/historiqueAchatsModel.php';

sessionStart();

//Vérification des requêtes AJAX : La variable $_SERVER['HTTP_X_REQUESTED_WITH'] est utilisée pour vérifier si la requête est une requête AJAX.
//Si c'est le cas,l'en-tête Content-Type: application/json est envoyé.
//Si la requête n'est pas une requête AJAX, l'en-tête JSON n'est pas envoyé, ce qui permet au navigateur de rendre la vue HTML normalement
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

$data = [];
if ($isAjax) {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
} else {
    $data = $_POST;
}


//db..................................................................
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$userModel = new UserModel($pdo);
$panierModel = new PanierModel($pdo);
$historiqueAchatsModel = new HistoriqueAchatsModel($pdo);

$user = $_SESSION['user'];
$user = $userModel->selectById($user->getId());
$_SESSION['user'] = $user;
$sumPanier = $panierModel->SumPanier($_SESSION['user']->getId());

//get item from index.................................................

if (!isset($_GET['id']))
    redirect("error");
else {
    $item = $itemModel->selectById($_GET['id']);
    $items = $itemModel->selectByInventory($_SESSION['user']->getId());
    foreach ($items as $itemSac) {
        if ($itemSac->getIdItem() == $_GET['id']) {
            $itemQt = $itemSac->getQteStock();
            break;
        }
    }
    if ($itemQt == 0) {
        redirect("error");
    }
    if ($item == null)
        redirect("error");
    $_SESSION['item'] = $item;
}
if (!isset($_SESSION['item']))
    redirect("error");

//Eat item......................................................

if (isPost()) {

    if ($data['action'] === 'delete') {
        if (!isset($_SESSION['user']))
            redirect("/connexion");
        $userModel->DeleteFromSac($_SESSION['user']->getId(), $_SESSION['item']->getIdItem());
    }
    if (isset($data['action']) && $data['action'] === "use") {



        if ($_SESSION['user']->getHp() < 100) {
            if (!isset($_SESSION['user']))
                redirect("/connexion");

            $userModel->useItem($_SESSION['user']->getId(), $_SESSION['item']->getIdItem());

            if (!$historiqueAchatsModel->isIn($_SESSION['user']->getId(), $_SESSION['item']->getIdItem())) {
                insertIntoBDHistoriqueAchats2($_SESSION['item']->getIdItem(), $historiqueAchatsModel, $_SESSION['user']->getId());

            }

            if (!isset($data['isMaxDex'])) {
                $dex = (int) $_SESSION['user']->getDexterite();

                if ($dex == 99) {
                    $dex = 100;
                    $userModel->nouvelleDexterite($dex, $_SESSION['user']->getId());
                    $_SESSION['user']->setDexterite($dex);

                } else {
                    $NouvelleDexterite = $dex + 2;
                    $userModel->nouvelleDexterite($NouvelleDexterite, $_SESSION['user']->getId());
                    $_SESSION['user']->setDexterite($NouvelleDexterite);
                }


            }
        }


    }
    
    if (isset($data['action']) && $data['action'] == "sell") {

        if (!isset($_SESSION['user']))
            redirect("/connexion");

        $userModel->sellItem($_SESSION['user']->getId(), $_SESSION['item']->getIdItem());

        if (!$historiqueAchatsModel->isIn($_SESSION['user']->getId(), $_SESSION['item']->getIdItem())) {
            insertIntoBDHistoriqueAchats2($_SESSION['item']->getIdItem(), $historiqueAchatsModel, $_SESSION['user']->getId());

        }


        if (!isset($data['isMaxDex'])) {

            $dex = (int) $_SESSION['user']->getDexterite();
            if ($dex == 99) {
                $dex = 100;
                $userModel->nouvelleDexterite($dex, $_SESSION['user']->getId());
                $_SESSION['user']->setDexterite($dex);

            } else {
                $NouvelleDexterite = $dex + 1;
                $userModel->nouvelleDexterite($NouvelleDexterite, $_SESSION['user']->getId());
                $_SESSION['user']->setDexterite($NouvelleDexterite);
            }


        }


    }

    // Gérer la redirection en fonction du type de requête
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        echo json_encode(['redirect' => '/inventaire']);//retournez une réponse JSON contenant l'URL de redirection.
        exit;//arrêter immédiatement l'exécution du script PHP après avoir envoyé une réponse JSON. Cela garantit que rien d'autre dans le fichier ne sera exécuté après avoir traité une requête AJAX.
    } else {
        redirect("/inventaire");
    }

    //MAJ de la session
    $_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());


    redirect("/inventaire");

}


//MAJ de la session
$_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
$_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

require 'views/item-sac.php';