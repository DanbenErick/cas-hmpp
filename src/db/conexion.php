<?php
    error_reporting(0);
    // defined("HOST")|
    // or define("HOST", "munipasco.gob.pe");

    // defined("USER")
    // or define("USER","cas_efweolc");

    // defined("PASSWORD")
    // or define("PASSWORD", "+y#U]rS;U1ww");

    // defined("DB_NAME")
    // or define("DB_NAME", "_munipasco_db_cas");

    defined("HOST")
    or define("HOST","localhost");

    defined("USER")
    or define("USER","root");

    defined("PASSWORD")
    or define("PASSWORD","");

    defined("DB_NAME")
    or define("DB_NAME", "cas_sistema2");



    // PHP 7
    //TODO: Verificar si el servidor usa PHP 7
    // if($mysqli->connect_error) {
    //     die("Error de Conexión ( $mysqli->connect_errno . )");
    // }

    $pdo = new PDO("mysql:host=".HOST.";dbname=". DB_NAME, USER, PASSWORD);

?>