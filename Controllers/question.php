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
if(!isset($_SESSION['bonus'])){
    $_SESSION['bonus'] = 0;
}
if($_SESSION['user']->getHp() <= 0) {
    redirect('/enigma');
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
    $question = $QuestionsModel->chercherQuestionSelonDifficulte($_SESSION['user']->getId(), $difficulty);

    if (!$question) { // Si aucune question n'est trouvée, redirigez vers la page d'énigmes (toutes les énigmes ont ete repondues))
        redirect('/enigma');
    }    

    $ReponseModel = new ReponseModel($pdo);
    $reponses = $ReponseModel->chercherReponses($question->getIdEgnime());
    shuffle($reponses);

    if (isPost()) { //envoi de reponse
        $_SESSION['reponse'] = $_POST['reponse'];
        $_SESSION['idEgnime'] = $_POST['idEgnime'];

        //MAJ de la session
        $_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
        $_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

        redirect('/reponse');
    }

} else {
    //MAJ de la session
    $_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

    redirect('/enigma');
}

//MAJ de la session
$_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
$_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

require "views/question.php";
