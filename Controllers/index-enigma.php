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


require 'views/index-enigma.php';