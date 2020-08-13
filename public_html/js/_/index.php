
<?php session_start();
if(@!$_SESSION['id_user'] && @!$_SESSION['id_rol']): ?>
<?php
    require("public_html/php/functions/functions.php");
    require("public_html/usuario/index.php");
?>
<?php else: header("Location: public_html/") ?>
<?php endif;?>
