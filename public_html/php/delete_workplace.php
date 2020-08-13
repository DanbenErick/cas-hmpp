<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1) {
        if($_GET['id'] != null) {
            require_once('../../src/config.php');
            require_once(PATH_CONN_DB);
            require_once("functions/functions.php");
            $result = delete_workplace($_GET['id']);
            if($result['code'] == 1) {
                volver("ok_delete");
            }else {
                var_dump($result['msg']);
                volver("appl_reg_to_work");
            }
        }else {
            volver("problem_delete_wp");
        }
    }else {
        volver();
    }
    function volver($parametro = "") {
        if($parametro != ""){
            header("Location: ../sistema/plaza.php?alert=$parametro");
        }else {
            header("Location: ../");
        }
    }

?>