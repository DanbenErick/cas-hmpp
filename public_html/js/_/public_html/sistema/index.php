<?php
session_start();
?>
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):?>
<?php
print("<script> console.log(".$_SESSION['id_denomination'].")</script>");
$ruta_section = "convocatoria";
require("../../src/config.php");

require(PATH_TEMPLATE  .'/headers_sistema.php');

require(PATH_TEMPLATE. '/nav.php');


?>
<main class="panel">
    <?php
    require(PATH_TEMPLATE. '/aside.php');

    require(PATH_TEMPLATE. '/section_sistema.php');
    ?>
</main>
    <?php if(@$_GET['alert']):?>
        <script src="../js/alert.js"></script>
        <script>
        <?php
        switch($_GET['alert']) {
            case 'ok':
                echo "okRegisterAnnouncement()";
                break;
            case 'empty_input':
                echo "emptyInputs()";
                break;
            case 'there_convocatory':
                echo "there_convocatory()";
                break;
            case 'ok_generate_document':
                echo "okGenerateDocument()";
                break;
            case 'fail_generate_documet':
                echo "failGenerateDocument()";
                break;
            case 'not_time':
                echo "notTime()";
                break;
            case 'fail_report':
                echo "failReport()";
                break;
        }
        ?>
        </script>
    <?php endif;?>
<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):  header("Location: ../supervisor") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>
