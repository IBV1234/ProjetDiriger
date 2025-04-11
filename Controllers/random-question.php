<?php
require 'src/session.php';
require 'src/class/database.php';
require 'src/class/User.php';
require 'models/QuestionModel.php';
require 'models/ReponseModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$QuestionsModel = new QuestionsModel($pdo);
$question = $QuestionsModel->select_question_reponses();

$ReponseModel = new ReponseModel($pdo);
$reponses = $ReponseModel->chercherReponses($question->getIdEgnime());
shuffle($reponses);

if (isPost()) {
    $idEgnime = (int)$_POST['idEgnime'];
    $reponse = $_POST['reponse'];
}

require "views/random-question.php";