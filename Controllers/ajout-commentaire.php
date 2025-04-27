<?php
if(isPost()){
require 'src/class/Database.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/CommentaireModel.php';
sessionStart();

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$commentairesModel = new CommentaireModel($pdo);
$idItem = (int)$_POST['idItem'] ?? null;
$comment = $_POST['comment']?? null;
$evalution =  (float)$_POST['evaluation']?? null;
$commentairesModel->insertCommentaire($idItem,$_SESSION['user']->getId(),$comment,$evalution);
redirectWitParams("/item",$idItem);
}else{
    redirect("/");
}
