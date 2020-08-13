<?php
session_start();
// $id = $_POST['id'];
if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1) {
    require_once("functions/detectar_vacio.php");
    $id = $_POST['id_plaza'];
    $cod = $_POST['cod_plaza'];
    $position = $_POST['nombre_plaza'];
    $dependencia = $_POST['dependencia_plaza'];
    $result = detectar_vacio($id,$cod,$position, $dependencia);
    if($result) {
        require_once('../../src/config.php');
        require_once('../php/functions/functions.php');
        $result = edit_workplace($id, $cod, $position, $dependencia);
        if($result['code'] == 1) {
            volver("ok_edit_workplace");
        }else {
            var_dump($result['msg']);
            volver("fail_edit");
        }
    }else {
        volver("empty_camps");
    }
}else {
    //Volver a la pagina principal
    volver();
}
function volver($parametro = "") {
    if($parametro != "") {
        global $id;
        if($parametro == "ok_edit_workplace") {
            header("Location: ../sistema/plaza.php?alert=$parametro");
        }else {
            header("Location: ../sistema/edit_plaza.php?alert=$parametro&id=".$id);
        }
    }else {
        header("Location: ../");
    }
}
?>
