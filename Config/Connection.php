<?php
    define("DB_HOST", "localhost");
    define("DB_NAME", "utnjobs");
    define("DB_USER", "root");
    define("DB_PASS", "");

    $connection = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
?>