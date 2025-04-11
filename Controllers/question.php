<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/User.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////



$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : null;

if ($difficulty) {

} else {
    redirect('/enigma');
}