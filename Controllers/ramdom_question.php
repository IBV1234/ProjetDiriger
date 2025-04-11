<?php
require 'src/session.php';
require 'src/class/database.php';
require 'models/model_Questions.php';

sessionStart();
$pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
$QuestionsModel = new QuestionsModel($pdo);
$questions = $QuestionsModel->select_question_reponses();

if (isPost()) {
    $idEgnime = (int)$_POST['idEgnime'];
    $reponse = $_POST['reponse'];
}

require "views/ramdom_question.php";