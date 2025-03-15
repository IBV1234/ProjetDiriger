<?php

function sessionStart(): void
{

    if (session_status() === PHP_SESSION_NONE) {

        session_start();
    }

}

function sessionDestroy(): void
{

    $_SESSION = [];//supprime les données de session de l'utilisateur côté serveur

    session_destroy();//Cette fonction détruit la session elle-même côté serveur

    $name = session_name();//Cette ligne récupère le nom du cookie de session (par défaut PHPSESSID), afin qu'il puisse être utilisé pour supprimer le cookie.

    /*
    $expire = new DateTime("-1 year"); et $expireTimestamp = $expire->getTimestamp();
    Ces lignes créent une date d'expiration passée (il y a un an), ce qui permet d'expirer le cookie en définissant
     une date d'expiration antérieure à la date actuelle.
    */
    $expire = new DateTime("-1 year");
    $expireTimestamp = $expire->getTimestamp();


    /*
    récupère les paramètres du cookie de session, comme le chemin (path), le domaine (domain), et les options de sécurité (secure et httponly),
     pour les utiliser dans la suppression du cookie.
    */
    $params = session_get_cookie_params();

    /*
    pelle setcookie avec le nom de la session et une date d'expiration passée pour supprimer le cookie côté client. 
    En spécifiant une date d'expiration antérieure et en reprenant les mêmes paramètres (path, domain, secure, httponly) que ceux de la session initiale,
     le cookie de session est supprimé de manière sécurisée.
    */
    setcookie(
        $name,
        "",
        $expireTimestamp,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );

}