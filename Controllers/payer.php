<?php

if(isPost()){

    require 'src/session.php';
    sessionStart();

    // Récupération des valeurs
    $maxPoids = intval($_POST['maxPoids']);
    $poids = floatval($_POST['poidsTotal']);
    $prix = floatval($_POST['prixTotal']);
    $items = $_POST['items'] ?? [];

    $panier = $_SESSION['panier'];

    $quantité = getQuantiy($items);
    $prixTotal = getPrixTotal( $panier,$quantité);
    $poidsTotal = getPoidsTotal($panier,$quantité);

    if(isset($_SESSION['sessionDex'])) {

        $dexterite = intval($_SESSION['sessionDex']);

        if ($poidsTotal > $maxPoids) {
            $dexterite -= 1;
            $_SESSION['sessionDex'] = $dexterite;
        }
    }

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

