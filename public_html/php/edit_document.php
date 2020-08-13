<?php
session_start();
if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1) {
    require_once("functions/detectar_vacio.php");
    $id = $_POST['id_documento'];
    $cod = $_POST['cod_documento'];
    $name = $_POST['nombre_documento'];
    $result = detectar_vacio($id,$cod,$name);
    if($result) {
        require_once('../../src/config.php');
        require_once('../php/functions/functions.php');
        $result = edit_document($id, $cod, $name);
        if($result['code'] == 1) {
            volver("ok_edit");
        }else {
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
        global $id;
        if($parametro != "") {
            if($parametro == "ok_edit") {
                header("Location: ../sistema/documentos.php?alert=$parametro");
            }else{
                header("Location: ../sistema/edit_document.php?alert=$parametro&id=".$id);
            }
        }else {
            header("Location: ../");
        }
    }
?>
