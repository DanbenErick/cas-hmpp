<?php
session_start();
if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1) {
    $denominacion = $_POST['con_nominacion'];
    $f_publicacion_start = $_POST['con_inicio_con'];
    $f_publicacion_end = $_POST['con_fin_con'];
    $f_etr_cv_inicio = $_POST['con_inicio_cv_etr'];
    $f_etr_cv_fin = $_POST['con_fin_cv_etr'];
    $f_eval_cv_inicio = $_POST['con_inicio_cv_eval'];
    $f_eval_cv_fin = $_POST['con_fin_cv_eval'];
    $f_publicacion_aptos = $_POST['con_publicacion_aptos'];
    $f_entre_inicio = $_POST['con_inicio_entrevista'];
    $f_entre_fin = $_POST['con_fin_entrevista'];
    $f_publicacion_final = $_POST['con_publicacion'];
    $f_inicio_labor = $_POST['con_inicio_labores'];
    require_once('functions/detectar_vacio.php');
    $resultado = detectar_vacio(
        $denominacion,
        $f_publicacion_start,
        $f_publicacion_end,
        $f_etr_cv_inicio,
        $f_etr_cv_fin,
        $f_eval_cv_inicio,
        $f_eval_cv_fin,
        $f_publicacion_aptos,
        $f_entre_inicio,
        $f_entre_fin,
        $f_publicacion_final,
        $f_inicio_labor
    );
    if($resultado) {
        require_once("../../src/config.php");
        require_once('functions/functions.php');
        $update = edit_convocatory(
            $_SESSION['id_denomination'],
            $denominacion,
            $f_publicacion_start,
            $f_etr_cv_inicio,
            $f_etr_cv_fin,
            $f_eval_cv_inicio,
            $f_eval_cv_fin,
            $f_publicacion_aptos,
            $f_entre_inicio,
            $f_entre_fin,
            $f_publicacion_final,
            $f_inicio_labor
        );

        if($update['code'] == 1) {
            volver('ok_edit_convocatory');
        }else {
            // echo "<br>". $_SESSION['id_denomination'];
            // var_dump($update['msg']);
            volver('fail_edit_convocatory');
        }
    }else {
        volver('empty_camps');
    }
}else {
    volver();
}
    function volver($parametro = "") {
        global $id;
        if($parametro != "") {
            if($parametro == "ok_edit_convocatory") {
                header("Location: ../sistema/lista_convocatoria.php?alert=$parametro");
            }else {
                header("Location: ../sistema/edit_convocatoria.php?alert=$parametro&");
            }
        }else {
            header("Location: ../");
        }
    }
?>