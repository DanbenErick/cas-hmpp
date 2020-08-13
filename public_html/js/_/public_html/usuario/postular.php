<?php session_start();
require_once("../php/functions/functions.php");
$result = get_fechas_convocatoria()[0];
if(@!$_SESSION['id_user'] && @!$_SESSION['id_rol'] && $result['state_etr'] == 1):?>
    <?php
        require_once("../php/functions/functions.php");
        $plazas_disponibles = get_workplaces_users();
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postular</title>
    <link rel="stylesheet" href="../css/style-usuario.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h1>Formulario de Postulación</h1>
    <header class="header_postular">
        <h2>Rellene sus datos completos y con información auténtica.</h2>
    </header>
    <section>
        <div class="contenedor_form">
            <form action="../php/reg_applicant.php" id="formPostular"  method="POST" name="form_postulante" enctype="multipart/form-data">
                <div class="grupo_input">
                    <label>Nombres</label>
                    <input type="text" name="nombres">
                </div>
                <div class="grupo_input">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos">
                </div>
                <div class="grupo_input">
                    <label>DNI</label>
                    <input type="number" name="dni" maxlength="88888888 ">
                </div>
                <div class="grupo_input">
                    <label>Plaza</label>
                    <select name="plaza" id="plaza">
                        <?php if($plazas_disponibles != null):?>
                            <?php foreach($plazas_disponibles as $plaza):?>
                            <option value=<?= $plaza['id']?>><?= $plaza['cod_workplace'] . " -- " . $plaza['work_position'] . " -- " . $plaza['dependency']?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                <div class="grupo_input">
                    <label>Telefono</label>
                    <input type="number" name="telefono" max="999999999">
                </div>
                <div class="grupo_input">
                    <label>Documento</label>
                    <input type="file" name="documento" id="file-documento" accept=".pdf, .rar, .zip">
                    <small>Formatos Admitidos: PDF, .ZIP, .RAR Tamaño Maximo(4mb)</small>
                    <div class="alert" id="alert">Subiendo...</div>
                </div>
                <div class="grupo_input">
                    <div class="g-recaptcha" data-sitekey="6LdMf9kUAAAAACSXXm3Q3aBAA-AePgJjIY1NUq3B"></div>
                </div>
                <div class="grupo_input">
                    <button type="submit">Postular</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        //Script para subir archivo
    </script>
    <?php if(@$_GET['alert'] != null):?>
        <script src="../js/alert.js"></script>
        <?php
            switch($_GET['alert']){
                case 'ok':
                    echo "<script> okRegisterApplicant() </script>";
                    break;
                case 'fail_register_applicant':
                    echo "<script> failRegisterApplicant() </script>";
                    break;
                case 'max_intents':
                    echo "<script> maxIntents() </script>";
                    break;
                case 'empty_camps':
                    echo "<script>emptyInputs() </script>";
                    break;
                case 'camps_error':
                    echo "<script> errorCamps() </script>";
                    break;
                case 'not_validate_captcha':
                    echo "<script> notValidateCaptchanotValidateCaptcha() </script>";
                    break;
            }
        ?>
    <?php endif;?>
</body>
</html>
<?php else: header("Location: ../../")?>
<?php endif;?>