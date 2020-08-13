<?php
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
    $vacio = detectar_vacio($nombres, $apellidos, $dni, $plaza, $telefono, $documento, $recaptcha);
    // var_dump($vacio);
    if($vacio) {
        require_once("../php/functions/functions.php");
        if(strlen($dni) == 8 && strlen($telefono) == 9) {
            // volver("camps_error");
        }
        $result_insert = set_applicant_presencial($nombres, $apellidos, $dni, $plaza, $telefono, $documento);
        echo "funcion";
        if($result_insert['code'] == 1) {
            echo "Primer Documento";
            $plaza = get_workplaces_users()[0];
            $pl = $plaza['cod_workplace'] . " -- " . $plaza['work_position'] . " -- " . $plaza['dependency'];
            var_dump("ingreso");
            header("Location: ../usuario/resumen.php?name=$nombres&lastname=$apellidos&dni=$dni&workplace=$pl&phone=$telefono");
        }else if($result_insert['code'] == 2) {
            echo "Segundo Documento";
            var_dump($result_insert["msg"]);
            volver("fail_register_applicant");
        }else {
            echo "Tercer Documento";
            volver("max_intents");
        }
    }else {
        volver("empty_camps");
    }
} else {
    volver("not_validate_captcha");
}

function volver($parametro = "") {
    if($parametro != ""){
        header("Location: ../supervisor/index.php?alert=$parametro");
    }else {
        header("Location: ../supervisor/");
    }
}
?>
