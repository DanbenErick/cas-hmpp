<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1 ):
    require_once("../../src/config.php");
    // require_once("../php/functions/functions.php");
    // $resultado_usuarios = get_users();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../css/style-admin.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php require_once(PATH_TEMPLATE."/nav.php");?>
    <header>
        <h1>Crear Usuario</h1>
    </header>
    <div class="contenedor">
        <section class="section_form">
            <div class="contenedor_form">
                <form action="../php/reg_user.php" id="form_create_user" method="POST">
                    <div class="grupo_input">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre">
                    </div>
                    <div class="grupo_input">
                        <label for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario">
                    </div>
                    <div class="grupo_input">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="grupo_input">
                        <label for="type_user">Tipo de Usuario</label>
                        <select name="type_user" id="type_user">
                            <option value="2">Supervisor</option>
                        </select>
                    </div>
                    <div class="grupo_input">
                        <button type="submit">Registrar Usuario</button>
                    </div>
                </form>
            </div>
        </section>
        <section class="section_table">
            <header>
                <h1>Usuarios</h1>
            </header>
            <div class="contenedor_table">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                            <th>Usuario</th>
                            <th>Tipo de Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$resultado_usuarios != null):?>
                            <?php foreach($resultado_usuarios as $user):?>
                                <tr>
                                    <td><?= $user['name'] ?></td>
                                    <td>
                                        <a href=<?= "edit_user.php?id=" . $user['id']?> class="icon-pencil"></a>
                                        <!-- <a href=<?= "delete_user.php?id=" . $user['id']?> class="icon-trash"></a> -->
                                    </td>
                                    <td><?= $user['user'] ?></td>
                                    <td><?= $user['id_rol'] == 1 ? "Sistema" : "Supervisor" ?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <script src="../js/alert.js"></script>
    <?php if(@$_GET['alert'] != null):?>
        <?php
            switch($_GET['alert']) {
                case 'ok':
                    echo "<script>okRegisterUser()</script>";
                    break;
                case 'fail':
                    echo "<script>failRegisterUser</script>";
                    break;
                case 'empty_camps':
                    echo "<script>emptyInputs()</script>";
                    break;
                case 'ok_edit':
                    echo "<script>editUserOk()</script>";
                    break;
                case 'fail_edit':
                    echo "<script>editUserFail()</script>";
                    break;
            }
        ?>
    <?php endif;?>
</body>
</html>
<?php else: header("Location: ../");?>
<?php endif;?>