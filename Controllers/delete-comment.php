<?php
require 'src/class/Database.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/CommentaireModel.php';
sessionStart();

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$commentairesModel = new CommentaireModel($pdo);

$idItem = (int)$_GET['id'] ?? null;
$idJoueur =(int)$_GET['idJoueur'] ?? null;
$commentairesModel->deleteComment($idItem,$idJoueur);
redirectWitParams("/item",$idItem);

