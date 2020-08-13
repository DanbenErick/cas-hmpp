<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1) {
        if($_GET['id'] != null) {
            require_once('../../src/config.php');
            require_once(PATH_CONN_DB);
            require_once("functions/functions.php");
            $result = delete_convocatory($_GET['id']);
            var_dump($result);
            if($result['code'] == 1) {
                volver("ok");
            }
        }else {
            volver("problem_delete_con");
        }
    }else {
        volver();
    }
    function volver($parametro = "") {
        if($parametro != ""){
            header("Location: ../sistema/lista_convocatoria.php?alert=$parametro");
        }else {
            header("Location: ../");
        }
    }
?>