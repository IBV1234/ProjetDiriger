<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/User.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}

if(!isset($_SESSION['bonus'])){
    $_SESSION['bonus'] = 0;
}
///////////////////////////////////////

require 'views/index-enigma.php';