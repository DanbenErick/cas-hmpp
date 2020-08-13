<?php
session_start();
require_once('../../src/config.php');
// if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):

if(isset($_POST['crear_con'])) {
    if($_SESSION['id_rol'] == 1) {
        require_once('functions/detectar_vacio.php');
        $nominacion = $_POST['con_nominacion'];
        $f_inicio_con = $_POST['con_inicio_con'];
        // $f_fin_con = $_POST['con_fin_con'];
        $f_publicacion_aptos = $_POST['con_publicacion_aptos'];
        $f_inicio_entre_cv = $_POST['con_inicio_cv_etr'];
        $f_fin_entre_cv = $_POST['con_fin_cv_etr'];
        $f_inicio_cv_eval = $_POST['con_inicio_cv_eval'];
        $f_fin_cv_eval = $_POST['con_fin_cv_eval'];
        $f_inicio_entrevista = $_POST['con_inicio_entrevista'];
        $f_fin_entrevista = $_POST['con_fin_entrevista'];
        $f_publicacion_final = $_POST['con_publicacion'];
        $f_inicio_labores = $_POST['con_inicio_labores'];
        $hoy = date("Y-m-d");
        $valor_inicial = 0;
        $inicial_estado = 1;

        $vacio = detectar_vacio(
            $nominacion,
            $f_inicio_con,
            // $f_fin_con,
            $f_publicacion_aptos,
            $f_inicio_entre_cv,
            $f_fin_entre_cv,
            $f_inicio_cv_eval,
            $f_fin_cv_eval,
            $f_inicio_entrevista,
            $f_fin_entrevista,
            $f_publicacion_final,
            $f_inicio_labores
        );
        if($vacio) {
            require_once(PATH_CONN_DB);
            require_once("functions/functions.php");
            $resultado = verify_state_convocatoty();
            if($resultado['code'] == 0) {
                volver("there_convocatory");
            }else {
                if($resultado['code'] === 1) {
                    $sql = "INSERT INTO announcements ( denomination, f_publication, f_cv_start, f_cv_end, f_eval_cv_start, f_eval_cv_end, f_publication_accepted, f_interview_start, f_interview_end, f_publication_end, f_start_work, id_creator, f_creation, f_last_edition, quantity_edition, state, visible) VALUES
                    (:denominacion,
                    :f_publicacion,
                    :f_incio_entrega_cv,
                    :f_fin_entrega_cv,
                    :f_inicio_eval_cv,
                    :f_fin_eval_cv,
                    :f_publicacion_aptos,
                    :f_inicio_entrevista,
                    :f_fin_entrevista,
                    :f_publicacion_final,
                    :f_inicio_labores,
                    :id_creador,
                    :f_creacion,
                    :f_ultima_modificacion,
                    :cantidad_ediciones,
                    :estado,
                    :visible)";
                    $insertar = $pdo->prepare($sql);
                    $insertar->bindParam(":denominacion", $nominacion);
                    $insertar->bindParam(":f_publicacion", $f_inicio_con);
                    $insertar->bindParam(":f_incio_entrega_cv", $f_inicio_entre_cv);
                    $insertar->bindParam(":f_fin_entrega_cv", $f_fin_entre_cv);
                    $insertar->bindParam(":f_inicio_eval_cv", $f_inicio_cv_eval);
                    $insertar->bindParam(":f_fin_eval_cv", $f_fin_cv_eval);
                    $insertar->bindParam(":f_publicacion_aptos", $f_publicacion_aptos);
                    $insertar->bindParam(":f_inicio_entrevista", $f_inicio_entrevista);
                    $insertar->bindParam(":f_fin_entrevista", $f_fin_entrevista);
                    $insertar->bindParam(":f_publicacion_final", $f_publicacion_final);
                    $insertar->bindParam(":f_inicio_labores", $f_inicio_labores);
                    $insertar->bindParam(":id_creador", $_SESSION['id_user']);
                    $insertar->bindParam(":f_creacion", $hoy);
                    $insertar->bindParam(":f_ultima_modificacion", $hoy);
                    $insertar->bindParam(":cantidad_ediciones", $valor_inicial);
                    $insertar->bindParam(":estado", $inicial_estado);
                    $insertar->bindParam(":visible",$inicial_estado);
                    if($insertar->execute()) {
                        $sql_last_con = "SELECT * FROM announcements WHERE id = (SELECT MAX(id) FROM announcements WHERE state = 1)";
                        global $pdo;
                        $query_last_conn = $pdo->prepare($sql_last_con);
                        if($query_last_conn->execute()) {
                            $_SESSION['id_denomination'] = $query_last_conn->fetchAll()[0]['id'];
                            echo $_SESSION['id_denomination'];
                            volver("ok");
                        }
                    }else {
                        var_dump($insertar->errorInfo());
                    }
                }else if($resultado['code'] == 2){
                    $sql = "INSERT INTO announcements ( denomination, f_publication, f_cv_start, f_cv_end, f_eval_cv_start, f_eval_cv_end, f_publication_accepted, f_interview_start, f_interview_end, f_publication_end, f_start_work, id_creator, f_creation, f_last_edition, quantity_edition, state, visible) VALUES
                    (:denominacion,
                    :f_publicacion,
                    :f_incio_entrega_cv,
                    :f_fin_entrega_cv,
                    :f_inicio_eval_cv,
                    :f_fin_eval_cv,
                    :f_publicacion_aptos,
                    :f_inicio_entrevista,
                    :f_fin_entrevista,
                    :f_publicacion_final,
                    :f_inicio_labores,
                    :id_creador,
                    :f_creacion,
                    :f_ultima_modificacion,
                    :cantidad_ediciones,
                    :estado,
                    :visible)";
                    $insertar = $pdo->prepare($sql);
                    $insertar->bindParam(":denominacion", $nominacion);
                    $insertar->bindParam(":f_publicacion", $f_inicio_con);
                    $insertar->bindParam(":f_incio_entrega_cv", $f_inicio_entre_cv);
                    $insertar->bindParam(":f_fin_entrega_cv", $f_fin_entre_cv);
                    $insertar->bindParam(":f_inicio_eval_cv", $f_inicio_cv_eval);
                    $insertar->bindParam(":f_fin_eval_cv", $f_fin_cv_eval);
                    $insertar->bindParam(":f_publicacion_aptos", $f_publicacion_aptos);
                    $insertar->bindParam(":f_inicio_entrevista", $f_inicio_entrevista);
                    $insertar->bindParam(":f_fin_entrevista", $f_fin_entrevista);
                    $insertar->bindParam(":f_publicacion_final", $f_publicacion_final);
                    $insertar->bindParam(":f_inicio_labores", $f_inicio_labores);
                    $insertar->bindParam(":id_creador", $_SESSION['id_user']);
                    $insertar->bindParam(":f_creacion", $hoy);
                    $insertar->bindParam(":f_ultima_modificacion", $hoy);
                    $insertar->bindParam(":cantidad_ediciones", $valor_inicial);
                    $insertar->bindParam(":estado", $inicial_estado);
                    $insertar->bindParam(":visible",$inicial_estado);
                    if($insertar->execute()) {
                        volver("ok");
                    }else {
                        var_dump($insertar->errorInfo());
                    }
                }
            }
        }else {
            echo "No rellenaste todos los campos requeridos";
            volver("empty_input");
        }
    }else {
        echo "No tienes permiso para poder Crear";
        volver("no_permission");
    }
}else {
    volver("delete");
}

function volver($parametro = "") {
    if($parametro != ""){
        header("Location: ../sistema/index.php?alert=$parametro");
    }else {
        header("Location: ../");
    }
}



?>