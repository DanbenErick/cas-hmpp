<?php
session_start();
?>
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):?>
<?php

$ruta_section = "documento";
require_once("../../src/config.php");
require_once(PATH_CONN_DB);
require(PATH_TEMPLATE  .'/headers_sistema.php');
?>
<body>
<?php
require(PATH_TEMPLATE. '/nav.php');
?>

    <main class="panel">
        <?php
        require(PATH_TEMPLATE. '/aside.php');
        require('../php/functions/functions.php');
        $table_documents = get_documents();
        require(PATH_TEMPLATE. '/section_sistema.php');
        ?>
    </main>
    <script src="../js/script.js"></script>
    <?php if(@$_GET['alert']):?>
        <script src="../js/alert.js"></script>
        <script>
        <?php
            switch($_GET['alert']){
                case 'ok':
                    echo "okUploadFile()";
                    break;
                case 'upload_fail':
                    echo "failUploadFile()";
                    break;
                case 'empty_input':
                    echo "emptyInputs()";
                    break;
                case 'there_document_code':
                    echo "thereDocumentCode()";
                    break;
                case 'format_invalid':
                    echo "formatInvalid()";
                    break;
                case 'problem_delete_wp':
                    echo "problemDeleteDocument()";
                    break;
                case 'ok_delete':
                    echo "okDeleteDocument()";
                    break;
                case 'ok_edit':
                    echo "okEditDocument()";
                    break;
            }
        ?>
        </script>
    <?php endif;?>
</body>
</html>
<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):  header("Location: ../supervisor") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>
