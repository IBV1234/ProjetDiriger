<?php

require 'src/class/Database.php';

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

require 'views/index.php';