<?php
    require_once("../php/functions/detectar_vacio.php");
    @$nombres = $_GET['name'];
    @$apellidos = $_GET['lastname'];
    @$dni = $_GET['dni'];
    @$cargo = $_GET['workplace'];
    @$telefono = $_GET['phone'];
    @$resultado = detectar_vacio($nombres, $apellidos, $dni, $cargo, $telefono);
    date_default_timezone_set("America/Lima");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen</title>
    <link rel="stylesheet" href="../css/style-resumen.css">
</head>
<body>
    <h1>Resumen de los Datos Registrados</h1>
    <?php if($resultado != null):?>
    <section>
        <div class="group">
            <b>Nombres</b>
            <p><?= $nombres ?></p>
        </div>
        <div class="group">
            <b>Apellidos</b>
            <p><?= $apellidos ?></p>
        </div>
        <div class="group">
            <b>Numero de DNI</b>
            <p><?= $dni ?></p>
        </div>
        <div class="group">
            <b>Cargo al que Postula</b>
            <p><?= $cargo ?></p>
        </div>
        <div class="group">
            <b>Numero de Telefono</b>
            <p><?= $telefono ?></p>
        </div>
        <div class="group">
            <b>Hora y Fecha de Registro</b>
            <p><?= date("G:i:s d-m-Y")?></p>
        </div>
        <div class="container_volver">
            <a href="http://cas.munipasco.gob.pe">Volver a la Municipalidad</a>
        </div>
    </section>
    <?php else:?>
        <section>
        <div class="group">
            <b>Nombres</b>
            <p>No hay Contenido</p>
        </div>
        <div class="group">
            <b>Apellidos</b>
            <p>No hay Contenido</p>
        </div>
        <div class="group">
            <b>Numero de DNI</b>
            <p>No hay Contenido</p>
        </div>
        <div class="group">
            <b>Cargo al que Postula</b>
            <p>No hay Contenido</p>
        </div>
        <div class="group">
            <b>Numero de Telefono</b>
            <p>No hay Contenido</p>
        </div>
        <div class="group">
            <b>Hora y Fecha de Registro</b>
            <p>No hay Contenido</p>
        </div>
        <div class="container_volver">
            <a href="http://munipasco.gob.pe">Volver</a>
        </div>
    </section>
    <?php endif;?>
</body>
</html>