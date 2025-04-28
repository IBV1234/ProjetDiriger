<?php
require 'src/session.php';
require 'src/class/Database.php';
require 'src/class/User.php';
require 'models/QuestionModel.php';
require 'models/ReponseModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
if(!isset($_SESSION['bonus'])){
    $_SESSION['bonus'] = 0;
}
///////////////////////////////////////

$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$QuestionsModel = new QuestionsModel($pdo);
$question = $QuestionsModel->select_question_reponses($_SESSION['user']->getId());

if (!$question) { // Si aucune question n'est trouvée, redirigez vers la page d'énigmes (toutes les énigmes ont ete repondues))
    redirect('/enigma');
}

$ReponseModel = new ReponseModel($pdo);
$reponses = $ReponseModel->chercherReponses($question->getIdEgnime());
shuffle($reponses);

if (isPost()) {
    $_SESSION['reponse'] = $_POST['reponse'];
    $_SESSION['idEgnime'] = $_POST['idEgnime'];
    redirect('/reponse');
}

require "views/random-question.php";