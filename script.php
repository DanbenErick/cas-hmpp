<?php
    date_default_timezone_set("America/Lima");
    require_once("src/config.php");
    require_once(PATH_CONN_DB);
    $hoy = date("Y-m-d");

    $sql = "SELECT * FROM announcements where id = (SELECT MAX(id) from announcements WHERE state = 1)";

    $query = $pdo->prepare($sql);

    if($query->execute()) {
        $resultado = $query->fetchAll()[0];

        //Entrega de Curriculo Vitae
        if($hoy >= $resultado['f_cv_start'] && $hoy <= $resultado['f_cv_end']) {
            $sql_update = "UPDATE announcements SET state_etr = 1 WHERE id= (SELECT MAX(id) from announcements WHERE state = 1)";
            $update = $pdo->prepare($sql_update);
            if($update->execute()) {
                // echo "Exitoso";
            }else {
                // echo $update->errorInfo();
            }
        }else {
            // echo "Entrega de Documentos Terminada";
            $sql_update = "UPDATE announcements SET state_etr = 0 WHERE id=(SELECT MAX(id) from announcements WHERE state = 1)";
            $update = $pdo->prepare($sql_update);
            if($update->execute()) {
                //ok
            }else {
                //Problem
            }
        }


        //Evaluacion de Curriculo Vitae
        if($hoy >= $resultado['f_eval_cv_start'] && $hoy <= $resultado['f_eval_cv_end']) {
            //Dentro del rango de fechas
            $sql_insert = "UPDATE announcements SET state_eval = 1 WHERE id = (SELECT MAX(id) from announcements WHERE state = 1)";
            $update = $pdo->prepare($sql_insert);
            if($update->execute()) {
                // echo "<br>Exitoso<br>";
            }else {
                // echo "<br>No Fue Exitoso<br>";
                // echo $update->errorInfo();
            }
        }else {
            //No Estas dentro del rango de fechas
            $sql_insert = "UPDATE announcements SET state_eval = 0 WHERE id = (SELECT MAX(id) from announcements WHERE state = 1)";
            $update = $pdo->prepare($sql_insert);
            if($update->execute()) {
                // Operacion Exitosa
            }else {
                // echo $update->errorInfo();
            }
        }
    }else {
        // var_dump($resultado->errorInfo());
    }
?>

