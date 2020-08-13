<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):
?>
    <?php
        if(isset($_POST['crear_plaza'])) {
            require_once('../../src/config.php');
            require_once('functions/detectar_vacio.php');
            require_once('functions/functions.php');
            $cod_plaza = $_POST['cod_plaza'];
            $nombre_plaza = $_POST['nombre_plaza'];
            $dependencia_plaza = $_POST['dependencia_plaza'];
            if(detectar_vacio($cod_plaza, $nombre_plaza)) {
                $result_verify = verify_code_workplaces($cod_plaza)['code'];
                if($result_verify == 1) {
                    volver("there_workplace_code");
                }else {
                    require_once(PATH_CONN_DB);
                    $sql_insert = "INSERT INTO workplaces ( cod_workplace, work_position, id_denomination, id_creator, dependency) VALUES (:cod_plaza,:cargo_plaza, :id_convocatoria, :id_creador, :dependency)";
                    $insertar = $pdo->prepare($sql_insert);
                    $insertar->bindParam(":cod_plaza",$cod_plaza);
                    $insertar->bindParam(":cargo_plaza", $nombre_plaza);
                    $insertar->bindParam(":id_convocatoria", $_SESSION['id_denomination']);
                    $insertar->bindParam(":id_creador", $_SESSION['id_user']);
                    $insertar->bindParam(":dependency", $dependencia_plaza);
                    $insertar->execute();
                    volver("ok");
                }
            }else {
                volver("empty_input");
            }
        }
    ?>
<?php else:
    volver();
?>

<?php endif;?>

<?php
    function volver($parametro = "") {
        if($parametro != "") {
            header("Location: ../sistema/plaza.php?alert=$parametro");
        }else {
            header("Location: ../");
        }
    }

?>