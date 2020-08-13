<?php
session_start();
?>
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):?>
<?php

$ruta_section = "lista-convocatoria";
require("../../src/config.php");

require(PATH_TEMPLATE  .'/headers_sistema.php');

require(PATH_TEMPLATE. '/nav.php');


?>
<main class="panel">
    <?php
    require(PATH_TEMPLATE. '/aside.php');
    require_once('../php/functions/functions.php');
    $table_convocatory = get_convocatory();
    require(PATH_TEMPLATE. '/section_sistema.php');
    ?>
</main>
    <?php if(@$_GET['alert']):?>
        <script src="../js/alert.js"></script>
        <script>
        <?php
            switch($_GET['alert']) {
                case 'ok':
                    echo "okDeleteConvocatory()";
                    break;
                case 'problem_delete_con':
                    echo "problemDeleteConvocatory()";
                    break;
                case 'ok_edit_convocatory':
                    echo "okEditConvocatory()";
                    break;
            }
        ?>
        </script>
    <?php endif;?>
<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):  header("Location: ../supervisor") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>
