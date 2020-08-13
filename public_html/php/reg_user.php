<?php
    require_once("../../src/config.php");
    session_start();
    require_once("../php/functions/detectar_vacio.php");
    require_once("../php/functions/functions.php");
    $name = $_POST['nombre'];
    $user = $_POST['usuario'];
    $pass = $_POST['password'];
    $id_rol = $_POST['type_user'];

    if(detectar_vacio($name, $user, $pass, $id_rol)) {
        $new_password = password_hash($pass, PASSWORD_DEFAULT);
        $resultado_insert = set_user($name, $user, $new_password, $id_rol, 1);
        if($resultado_insert['code'] == 1) {
            volver("ok");
        }else {
            volver("fail_register");
        }
    }else {
        volver("empty_camps");
    }

    function volver($parametro = "") {
        if($parametro != ""){
            header("Location: ../admin/index.php?alert=$parametro");
        }else {
            header("Location: ../");
        }
    }
?>