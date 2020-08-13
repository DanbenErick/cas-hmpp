<?php
session_start();
?>
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):?>
<?php

$ruta_section = "plaza";
require_once("../../src/config.php");

require_once(PATH_TEMPLATE  .'/headers_sistema.php');

require_once(PATH_TEMPLATE. '/nav.php');


?>
<main class="panel">
    <?php
    require_once(PATH_TEMPLATE. '/aside.php');

    require_once('../php/functions/functions.php');
    $table_plazas = get_workplaces();
    require_once(PATH_TEMPLATE. '/section_sistema.php');
    ?>
</main>
    <?php if(@$_GET['alert']):?>
        <script src="../js/alert.js"></script>
        <script>
        <?php
            switch($_GET['alert']){
                case 'ok':
                    echo "okRegisterWorkplace()";
                    break;
                case 'empty_input':
                    echo "emptyInputs()";
                    break;
                case 'there_workplace_code':
                    echo "thereWorkplaceCode()";
                    break;
                case 'problem_delete_wp':
                    echo "problemDeleteWP()";
                    break;
                case 'ok_delete':
                    echo "okDeleteWorkplace()";
                    break;
                case 'ok_edit_workplace':
                    echo "okEditWorkplace()";
                    break;
                case 'appl_reg_to_work':
                    echo "applicantRegiserToWP()";
                    break;
            }
        ?>
        </script>
    <?php endif;?>
</body>
</html>
<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):  header("Location: ../") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>

