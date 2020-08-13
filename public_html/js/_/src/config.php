<?php
    // error_reporting(0);
    // $ruta_section = "";
    defined("PATH_TEMPLATE")
    or define("PATH_TEMPLATE", realpath(dirname(__FILE__). '/templates'));

    defined("PATH_CONN_DB")
    or define("PATH_CONN_DB", realpath(dirname(__FILE__). '/db/conexion.php'));

    defined("PATH_PAGES")
    or define("PATH_PAGES", realpath(dirname(__DIR__)."/public_html"));

    defined("PATH_FILES")
    or define("PATH_FILES", realpath(dirname(__DIR__)."/public_html/files"));
?>