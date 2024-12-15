<?php

// Db configs.
define('HOST', 'localhost');
define('PORT', 3306);
define('DATABASE', 'fcm_notifikasi');
define('USERNAME', 'root');
define('PASSWORD', '');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqliDriver = new mysqli_driver();
$mysqliDriver->report_mode = (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connection = new mysqli(HOST, USERNAME, PASSWORD, DATABASE, PORT);

$connection->set_charset('utf8mb4');
