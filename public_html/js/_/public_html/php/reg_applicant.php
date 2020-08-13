<?php

require_once("../../src/config.php");
require_once(PATH_CONN_DB);
$hoy = date("Y-m-d");

$sql = "SELECT * FROM announcements where id = (SELECT MAX(id) from announcements WHERE state = 1)";

$query = $pdo->prepare($sql);

if($query->execute()) {
    function volver($parametro = "") {
        if($parametro != ""){
            header("Location: ../usuario/postular.php?alert=$parametro");
        }else {
            header("Location: ../usuario/");
        }
    }
    $result_query = $query->fetchAll()[0];
    // var_dump($result_query['state_etr']);
    if($result_query['state_etr'] == "1") {
        require_once("../php/functions/detectar_vacio.php");
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $plaza = $_POST['plaza'];
        $telefono = $_POST['telefono'];
        $documento = $_FILES['documento'];

        $recaptcha = $_POST['g-recaptcha-response'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LdMf9kUAAAAAAr_S5qopRZLV3i0JHxLo7mswBVH',
            'response' => $recaptcha
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = @file_get_contents($url, "", $context);
        $captcha_success = json_decode($verify);
        if ($captcha_success->success) {
            if(detectar_vacio($nombres, $apellidos, $dni, $plaza, $telefono, $documento, $recaptcha)) {
                require_once("../php/functions/functions.php");
                if(strlen($dni) == 8 && strlen($telefono) == 9) {
                    volver("camps_error");
                }
                $result_insert = set_applicant($nombres, $apellidos, $dni, $plaza, $telefono, $documento);
                if($result_insert['code'] == 1) {

                    $plaza = get_workplaces_users()[0];
                    $pl = $plaza['cod_workplace'] . " -- " . $plaza['work_position'] . " -- " . $plaza['dependency'];

                    header("Location: ../usuario/resumen.php?name=$nombres&lastname=$apellidos&dni=$dni&workplace=$pl&phone=$telefono");
                }else if($result_insert['code'] == 2) {
                    var_dump($result_insert["msg"]);
                    volver("fail_register_applicant");
                }else {
                    volver("max_intents");
                }
            }else {
                volver("empty_camps");
            }
        } else {
            volver("not_validate_captcha");
        }
    }
}
?>


