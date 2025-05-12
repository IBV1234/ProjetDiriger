<?php
require 'src/class/Database.php';
require 'src/session.php';
require 'models/QuestionModel.php';
require 'models/ReponseModel.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

//PDO
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();

//messages
$messageAvant = "Vous ne pouvez plus jouer !";
$srcImage = "public/images/gameover.png";
$_SESSION['user']->getHp() <= 0 ? $messageApres = "Vous n'avez plus de points de vie ! Revenez quand vous aurez rechargé votre vie !" : $messageApres = "Vous avez répondu à toutes les questions de cette catégorie !";

//MAJ de la session
$_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
$_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

require 'views/enigma-gameover.php';