<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/User.php';
require 'models/QuestionModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : null;

if ($difficulty) {
    //PDO
    $pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
    $QuestionsModel = new QuestionsModel($pdo);
    $questions = $QuestionsModel->select_question_reponses(); // !!!!!!!! a modifier pour la difficulté au lieu de random !!!!!!!!!!!!

    if (isPost()) {
        $idEgnime = (int)$_POST['idEgnime'];
        $reponse = $_POST['reponse'];
    }

} else {
    redirect('/enigma');
}

require "views/question.php";
