<?php

const ROUTE = [
    
    '/'=>'index.php'
];

const DB_PARAMS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_CASE => PDO::CASE_NATURAL,
    PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,        
];
// define(constant_name: 'CONFIGURATION', parse_ini_file("", true));