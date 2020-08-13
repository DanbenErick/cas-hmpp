<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):
    require_once("../../src/config.php");
    require_once("../php/functions/detectar_vacio.php");
    require_once("../php/functions/functions.php");
    $id = @$_GET['id'];
    $user;
    if($id != null && is_numeric($id)) {
        $user = get_user_for_id($id)[0];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/style-admin.css">
</head>
<body>
    <?php require_once(PATH_TEMPLATE. "/nav.php");?>
    <header>
        <h1>Editar Usuario: <?= $user['name']?></h1>
    </header>
    <section class="section-form">
        <form action="../php/edit_user.php" method="POST">
            <div class="grupo_input">
                <input type="hidden" id="id" name="id" value=<?= $user['id']?>>
            </div>
            <div class="grupo_input">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value=<?= $user['name'] ?>>
            </div>
            <div class="grupo_input">
                <label for="usuario">Usuario </label>
                <input type="text" id="usuario" name="usuario" value=<?= $user['user'] ?>>
            </div>
            <div class="grupo_input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="grupo_input">
                <input type="hidden" name="tipo_usuario" value=<?= $user['id_rol'] ?>>
            </div>
            <div class="grupo_input">
                <input type="hidden" name="estado" value=<?= $user['state']?>>
            </div>
            <div class="grupo_input">
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </section>
</body>
</html>
<?php else: header("Location: ../") ?>
<?php endif;?>