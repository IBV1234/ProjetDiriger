<?php
require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/User.php';
require 'models/QuestionModel.php';
require 'models/ReponseModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : null;

if ($difficulty) {
    switch($difficulty) {
        case 'easy':
            $difficulty = 'F';
            break;
        case 'medium':
            $difficulty = 'M';
            break;
        case 'hard':
            $difficulty = 'D';
            break;
    }

    //PDO
    $pdo = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS)->getPDO();
    $QuestionsModel = new QuestionsModel($pdo);
    $question = $QuestionsModel->chercherQuestionSelonDifficulte($difficulty);

    $ReponseModel = new ReponseModel($pdo);
    $reponses = $ReponseModel->chercherReponses($question->getIdEgnime());
    shuffle($reponses);

    if (isPost()) { //envoi de reponse
        $_SESSION['reponse'] = $_POST['reponse'];
        $_SESSION['idEgnime'] = $_POST['idEgnime'];
        redirect('/reponse');
    }

} else {
    redirect('/enigma');
}

require "views/question.php";
