<?php
    date_default_timezone_set("America/Lima");
    require_once("src/config.php");
    require_once(PATH_CONN_DB);
    $hoy = date("Y-m-d");
    $sql = "SELECT * FROM announcements where id = (SELECT MAX(id) from announcements) AND state = 1";
    $query = $pdo->prepare($sql);
    if($query->execute()) {
        $resultado = $query->fetchAll()[0];
        $sql2 = "SELECT MAX(id) from announcements WHERE state = 1";
        $query = $pdo->prepare($sql2);
        $query->execute();
        $indice = $query->fetchAll()[0][0];
        //Entrega de Curriculo Vitae
        if($hoy >= $resultado['f_cv_start'] && $hoy <= $resultado['f_cv_end']) {
            $sql_update = "UPDATE announcements SET state_etr = 1 WHERE id= :condicional";
            $update = $pdo->prepare($sql_update);
            $update->bindParam(":condicional", $indice);
            if($update->execute()) {
                // echo "Exitoso";
            }else {
                var_dump($update->errorInfo());
            }
        }else {
            // echo "Entrega de Documentos Terminada";
            $sql_update = "UPDATE announcements SET state_etr = 0 WHERE id=:condicional";
            $update = $pdo->prepare($sql_update);
            $update->bindParam(":condicional", $indice);
            if($update->execute()) {
                //ok
            }else {
                //Problem
                var_dump($update->errorInfo());
            }
        }


        //Evaluacion de Curriculo Vitae
        if($hoy >= $resultado['f_eval_cv_start'] && $hoy <= $resultado['f_eval_cv_end']) {
            //Dentro del rango de fechas
            $sql_insert = "UPDATE announcements SET state_eval = 1 WHERE id = :condicional";
            $update = $pdo->prepare($sql_insert);
            $update->bindParam(":condicional", $indice);
            if($update->execute()) {
                // echo "<br>Exitoso<br>";
            }else {
                // echo "<br>No Fue Exitoso<br>";
                var_dump($update->errorInfo());
            }
        }else {
            //No Estas dentro del rango de fechas
            $sql_insert = "UPDATE announcements SET state_eval = 0 WHERE id = :condicional";
            $update = $pdo->prepare($sql_insert);
            $update->bindParam(":condicional", $indice);
            if($update->execute()) {
                // Operacion Exitosa
            }else {
                var_dump($update->errorInfo());
            }
        }
        //Desactivacion de la Convocatoria
        $publicacion_final = date("Y-m-d", strtotime('+5 day',strtotime($resultado['f_publication_end'])));
        if($hoy >= $resultado['f_publication'] && $hoy <= $publicacion_final) {
            //Dentro del rango de fechas
            $sql_insert = "UPDATE announcements SET state = 1 WHERE id = :condicional";
            $update = $pdo->prepare($sql_insert);
            $update->bindParam(":condicional", $indice);
            if($update->execute()) {
                // echo "<br>Exitoso<br>";
            }else {
                // echo "<br>No Fue Exitoso<br>";
                var_dump($update->errorInfo());
            }
        }else {
            //No Estas dentro del rango de fechas
            $sql_insert = "UPDATE announcements SET state = 0 WHERE id = :condicional";
            $update = $pdo->prepare($sql_insert);
            $update->bindParam(":condicional", $indice);
            if($update->execute()) {
                // Operacion Exitosa
            }else {
                var_dump($update->errorInfo());
            }
        }
    }else {
        // var_dump($resultado->errorInfo());
    }
?>

