<?php

require 'src/class/Database.php';
require "src/session.php";
sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO(); 
// sessionDestroy();
require 'views/index.php';