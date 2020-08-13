<?php
session_start();
if($_SESSION['id_user'] && $_SESSION['id_rol'] == 2) {
    $id = $_GET['id'];
    $calificacion = $_GET['eval'];
    require_once("../php/functions/functions.php");
    if(accept_applicant($id, $calificacion)['code'] == 1) {
        volver("success_accept");
    }else {
        volver("error_accept");
    }
}else {
    header("Location: ../");
}
function volver($parametro = "") {
    if($parametro != ""){
        header("Location: ../supervisor/index.php?alert=$parametro");
    }else {
        header("Location: ../");
    }
}
?>