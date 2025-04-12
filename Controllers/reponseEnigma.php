<?php
require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/User.php';
require 'models/UserModel.php';
require 'models/QuestionModel.php';
require 'models/ReponseModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}

if(!isset($_SESSION['reponse']) || !isset($_SESSION['idEgnime'])) {
    redirect('/enigma');
}
///////////////////////////////////////

$idEgnime = $_SESSION['idEgnime'];
$idReponse = $_SESSION['reponse'];
$_SESSION['reponse'] = null;
$_SESSION['idEgnime'] = null;

//PDO
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$reponseModel = new ReponseModel($pdo);
$enigmeModel = new QuestionsModel($pdo);
$ModelUser = new UserModel($pdo);

//Chercher le data
$reponse = $reponseModel->selectReponseById($idReponse);
$question = $enigmeModel->selectEgnimeById($idEgnime);

if($reponse->getEstBonne() == 1) {
    //messages
    $messageAvant = "Bonne réponse !";
    $messageApres = strval($question->getCaps()) . " caps ont été ajoutés à votre compte Knapsack!";
    $srcImage = "public/images/valid.png";

    //update du solde
    $_SESSION['user']->setBalance($_SESSION['user']->getBalance() + $question->getCaps());
    $ModelUser->nouveauSolde($_SESSION['user']->getBalance(), $_SESSION['user']->getId());

} else {
    //messages
    $messageAvant = "Mauvaise réponse !";
    $messageApres = "Meilleure chance la prochaine fois !";
    $srcImage = "public/images/invalid.png";
}

require 'views/enigma-reponse.php';