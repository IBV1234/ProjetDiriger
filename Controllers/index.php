<?php

require 'src/class/Database.php';
require "src/session.php";
sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

require 'views/index.php';