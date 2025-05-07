<?php
require 'src/session.php';
require 'src/class/Database.php';
require 'models/QuestionModel.php';
require 'models/ReponseModel.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
if(!isset($_SESSION['bonus'])){
    $_SESSION['bonus'] = 0;
}
if($_SESSION['user']->getHp() <= 0) {
    redirect('/gameover');
}
///////////////////////////////////////

$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$QuestionsModel = new QuestionsModel($pdo);
$question = $QuestionsModel->select_question_reponses($_SESSION['user']->getId());

if (!$question) { // Si aucune question n'est trouvée, redirigez vers la page gameover (toutes les énigmes ont ete repondues))
    redirect('/gameover');
}

$ReponseModel = new ReponseModel($pdo);
$reponses = $ReponseModel->chercherReponses($question->getIdEgnime());
shuffle($reponses);

if (isPost()) {
    $_SESSION['reponse'] = $_POST['reponse'];
    $_SESSION['idEgnime'] = $_POST['idEgnime'];

    //MAJ de la session
    $_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

    redirect('/reponse');
}

//MAJ de la session
$_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
$_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

require "views/random-question.php";