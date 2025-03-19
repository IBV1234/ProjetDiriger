<?php

if(isPost()){

    require 'src/session.php';
    require 'src/class/Database.php';
    require 'Models/panier-model.php';

    sessionStart();

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $lePanier =  new PanierModel($pdo);


    // Récupération des valeurs
    $maxPoids = intval($_POST['maxPoids']);
    $poids = floatval($_POST['poidsTotal']);
    $prix = floatval($_POST['prixTotal']);
    $items = $_POST['items'] ?? [];


    // $panier = $_SESSION['panier'];

    $prixTotal = getPrixTotalPayer(   $items);
    $poidsTotal = getPoidsTotal($items );

    setSolde($prixTotal);

    if(isset($_SESSION['sessionDex'])) {

        $dexterite = intval($_SESSION['sessionDex']);

        if ($poidsTotal > $maxPoids) {
            $dexterite -= 1;
            $_SESSION['sessionDex'] = $dexterite;
        }
    }

    
    foreach($items as $key => $item){

        $id = (int)$item['id'];
        $quantité = (int)$item['quantite'];

        $lePanier->insert($id,  $quantité ,1);

    }

    $lePanier->insertSacADos(1);


    // Enregistrer la commande 
    $_SESSION['last_order'] = [
        'prixTotal' => $prixTotal,
        'poidsTotal' => $poidsTotal,
        'items' => $items
    ];
    
    $lastOrderJson = json_encode($_SESSION['last_order']);
    file_put_contents('Logs/last-order.txt', $lastOrderJson . PHP_EOL, FILE_APPEND);
    

    // mis en commnetaire pour tester
    // if(!empty($_SESSION['panier'])){
    //     PayerItemSession();
    // }
    redirect("/");
}
redirect("/");

