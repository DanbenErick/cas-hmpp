<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):
?>
    <?php
        require_once('../../src/config.php');
        require_once("functions/detectar_vacio.php");
        require_once("functions/functions.php");
        $nombre_documento = $_POST['nombre_documento'];
        $cod_documento = $_POST['cod_documento'];
        $file = $_FILES['ruta_documento'];
        $nombre_documento_file = $file['name'];
        $size_documento = $file['size'];
        $tipo_documento = $file['type'];
        $ruta_temporal = $file['tmp_name'];
        if(detectar_vacio($nombre_documento_file, $size_documento, $tipo_documento, $ruta_temporal)){
            $result_verify = verify_code_documents($cod_documento)['code'];
            if($result_verify == 1) {
                volver("there_document_code");
            }else {
                if(explode("/", $tipo_documento)[1] == 'pdf') {
                    $hoy_time = time();
                    $destino = PATH_FILES . "/" . $hoy_time. ".pdf";
                    if(move_uploaded_file($ruta_temporal, $destino)) {
                        // "El archivo se subio correctamente";
                        require_once(PATH_CONN_DB);
                        $insertar = $pdo->prepare("INSERT INTO documents(cod_document, name_document, path_document, id_creator, id_denomination) VALUES (:cod_documento,:nombre_documento,:ruta_documento,:id_creador,:id_denomination)");
                        $insertar->bindParam(":cod_documento", $cod_documento);
                        $insertar->bindParam(":nombre_documento", $nombre_documento);
                        $insertar->bindParam(":ruta_documento", $hoy_time);
                        $insertar->bindParam(":id_creador", $_SESSION['id_user']);
                        $insertar->bindParam(":id_denomination", $_SESSION['id_denomination']);
                        if($insertar->execute()) {
                            echo "Ocurrio todo correctamente";
                            volver("ok");
                        }else {
                            echo $insertar->errorInfo();
                        }
                    }else {
                        echo "Ocurrio un problema al subir el archivo";
                        volver('upload_fail');
                    }
                }else {
                    volver("format_invalid");
                }
            }
        }else {
            print("No haz rellenado todos los campos requeridos");
            volver('empty_input');
        }
    ?>
<?php else:
    volver();
?>

<?php endif;?>

<?php
    function volver($parametro = "") {
        if($parametro){
            header("Location: ../sistema/documentos.php?alert=$parametro");
        }else {
            header("Location: ../sistema/documentos.php");
        }
    }

?>