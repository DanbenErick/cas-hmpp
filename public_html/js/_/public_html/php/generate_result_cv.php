<?php
session_start();
if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1) {
    date_default_timezone_set("America/Lima");
    require_once("../../src/config.php");
    require_once(PATH_CONN_DB);
    $hoy = date("Y-m-d");
    $sql = "SELECT * FROM announcements where id = (SELECT MAX(id) from announcements WHERE state = 1)";
    $query = $pdo->prepare($sql);

    if($query->execute()) {
        $resultado = $query->fetchAll()[0];
        if($hoy > $resultado['f_eval_cv_end']) {
            require_once '../../vendor/autoload.php';
            $mpdf = new \Mpdf\Mpdf();
            $id = $resultado['id'];
            ob_start();
            require_once '../../src/plantillas_reporte/reporte.php';
            $html = ob_get_clean();
            // $mpdf->Bookmark('Comienzo');
            $mpdf->WriteHTML($html);
            // $mpdf->Output();
            $name = "RESULTADO CV";
            $path = time();
            $path_complete = $path . ".pdf";
            $name_only = "resultado_cv_$id";
            $mpdf->Output("../files/$path_complete", "F");

            global $pdo;
            $sql_document = "INSERT INTO documents
                (name_document, path_document, id_creator, id_denomination)
                VALUES
                (:name, :path, :creator, (SELECT MAX(id) from announcements WHERE state = 1));
            ";
            $insert_document = $pdo->prepare($sql_document);
            $insert_document->bindParam(":name", $name);
            $insert_document->bindParam(":path", $path);
            $insert_document->bindParam(":creator", $_SESSION['id_user']);
            if($insert_document->execute()) {
                volver("ok_generate_document");
            }else {
                //
                volver("fail_generate_documet");
            }

        }else {
            //Aun no finaliza la entrega de cv
            volver("not_time");
        }
    }else {
        //No se ejecuto bien la consulta de tiempo
        volver("fail_report");
    }

}else {
    header("Location: ../");
}
function volver($parametro = "") {
    if($parametro != ""){
        header("Location: ../sistema/index.php?alert=$parametro");
    }else {
        header("Location: ../");
    }
}
?>