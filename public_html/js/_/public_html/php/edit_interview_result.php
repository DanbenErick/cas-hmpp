<?php
session_start();
if($_SESSION['id_user'] && $_SESSION['id_rol'] == 2) {
    require_once("../php/functions/detectar_vacio.php");
    require_once("../php/functions/functions.php");
    if($_POST['guardar'] == 1) {
        $id = $_POST['id'];
        $calificacion = $_POST['cal'];
        $estado = $_POST['res'];
        $vacio = detectar_vacio($id, $calificacion, $estado);
        if($vacio) {
            if(edit_interview_result_applicant($id, $calificacion, $estado)['code'] == 1) {
                volver("success_accept");
            }else {
                volver("error_accept");
            }
        }else {
            volver("empty_camps");
        }
    }else {
        $id = $_GET['id'];
        $calificacion = $_GET['eval'];
        $vacio = detectar_vacio($id, $calificacion);
        var_dump($vacio);
        if($vacio) {
            if(edit_interview_result_applicant($id, $calificacion)['code'] == 1) {
                volver("success_accept");
            }else {
                volver("error_accept");
            }
        }else {
            volver("empty_camps");
        }
    }
}else {
    header("Location: ../");
}
function volver($parametro = "") {
    if($parametro != ""){
        header("Location: ../supervisor/lista_final.php?alert=$parametro");
    }else {
        header("Location: ../");
    }
}
?>