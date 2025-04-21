<?php

// https://www.php.net/manual/fr/errorfunc.configuration.php

// https://www.php.net/manual/fr/ini.list.php

//==========================================================
// Gestion des erreurs : les fonctions internes de PHP utilisent principalement les erreurs
//==========================================================

// Ces configurationsprédominent celles dans php.ini le temps de l'exécution du script

// 1- error_reporting défini le niveau d'erreur rapporté par PHP

// Rapporte aucune erreur PHP
// error_reporting(0);

// Rapporte toutes les erreurs PHP
error_reporting(E_ALL);

//============

// 2- display_errors défini si on doit afficher les erreurs dans la page
// En production on mettrait 0 comme valeur
// Aucun effet si le script a des erreurs fatales

// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//=============

// 3- log_errors défini si on envoie les messages dans le log
// Par défaut : C:\wamp64\logs\php_error.log
ini_set('log_errors', 1);

//=============

// 4- error_log défini le chemin vers le fichier de log personnalisé
ini_set('error_log', 'logs/error.txt');

//=============

// 5- set_error_handler permet de défénir une fonction pour gérer les erreurs 
// Pas de logging automatique si on défini une fonction personnalisée
function customErrorHandler($error_level, $error_message, $error_file, $error_line)
{
  $message = "Error : $error_level | $error_message | $error_file | $error_line";
    error_log($message.PHP_EOL,3 ,"logs/error.txt"); // message_type: 3 veut dire que le message est ajouté au fichier destination.

    header('location: views/error.php');
}

// 6- On doit enregistrer la fonction personnalisée
// Cette fonction gère tout les types d'erreurs
// On pourrait avoir des fonctions différentes pour des types différents

set_error_handler('customErrorHandler', E_ALL);