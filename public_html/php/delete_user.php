<?php
    if(@$_GET['id'] != null) {
        $result_delete = delete_user($_GET['id']);
        if($result_delete['code'] == 1) {
            volver("ok_delete");
        }else {
            volver("fail_delete");
        }
    }
    function volver($parametro = "") {
        header("Location: ../sistema/lista_convocatoria.php?alert=$parametro");
    }

?>