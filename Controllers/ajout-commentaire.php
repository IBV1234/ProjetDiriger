<?php
require 'src/class/Database.php';
require 'src/session.php';
require 'models/CommentaireModel.php';

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$commentairesModel = new CommentaireModel($pdo);

require 'views/item.php';