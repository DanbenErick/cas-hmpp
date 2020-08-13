<?php
session_start();
if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):?>
    <?php
    require_once("../../src/config.php");
    require_once("../php/functions/detectar_vacio.php");
    require_once("../php/functions/functions.php");
        $id = $_POST['id'];
        $name = $_POST['nombre'];
        $user = $_POST['usuario'];
        $password = $_POST['password'];
        $id_rol = $_POST['tipo_usuario'];
        $estado = $_POST['estado'];
        function volver($parametro = "") {
            if($parametro != ""){
                header("Location: ../admin/index.php?alert=$parametro");
            }else {
                header("Location: ../");
            }
        }
        if(detectar_vacio($id, $name, $user, $password, $id_rol, $estado)) {
            $new_password = password_hash($password, PASSWORD_DEFAULT);
            $result = edit_user($id,$name,$user,$new_password,$id_rol, $estado);
            if($result['code'] == 1) {
                volver("ok_edit");
            }else {
                volver("fail_edit");
            }
        }else {
            volver("empty_camps");
        }
    ?>

<?php else: header("Location: ../")?>
<?php endif;?>