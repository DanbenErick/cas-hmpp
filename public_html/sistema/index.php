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
        <?php
        switch($_GET['alert']) {
            case 'ok':
                echo "<script> okRegisterAnnouncement() </script>";
                break;
            case 'empty_input':
                echo "<script> emptyInputs() </script>";
                break;
            case 'there_convocatory':
                echo "<script> there_convocatory() </script>";
                break;
        }
        ?>
    <?php endif;?>
<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):  header("Location: ../supervisor") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>
