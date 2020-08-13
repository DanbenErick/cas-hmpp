<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1 ):
?>
<?php
    require_once("../../src/config.php");
    require_once("../php/functions/functions.php");
    $id = $_GET['id'];
    $plaza = get_workplace_by_id($id)[0];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plaza</title>
    <link rel="stylesheet" href="../css/style-edit-con.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <main>
        <section class="crear-plaza">
            <div class="contenedor">
                <h1>Editar Plaza</h1>
                <div class="contenedor-form">
                    <form action="../php/edit_workplace.php" method="POST" class="form">
                        <div class="grupo-input">
                            <input type="hidden" name="id_plaza" value=<?= $plaza['id']?>>
                        </div>
                        <div class="grupo-input">
                            <label>Codigo de la Plaza</label>
                            <input type="text" placeholder="Codigo" name="cod_plaza" value=<?= $plaza['cod_workplace']?>>
                        </div>
                        <div class="grupo-input">
                            <label>Nombre de la Plaza</label>
                            <input type="text" placeholder="Nombre" name="nombre_plaza" id="namePlaza">
                        </div>
                        <div class="grupo-input">
                            <label>Dependencia de la Plaza</label>
                            <input type="text" placeholder="Dependencia" name="dependencia_plaza" id="dependency">
                        </div>
                        <div class="grupo-input">
                            <button type="submit" name="crear_plaza">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php if(@$_GET['alert'] != null):?>
        <script src="../js/alert.js"></script>
        <script>
            <?php
                switch($_GET['alert']) {
                    case 'fail_edit':
                        echo "failEditWorkplace()";
                        break;
                    case 'empty_camps':
                        echo "emptyInputs()";
                        break;
                }
            ?>
        </script>
    <?php endif;?>
    <script>
        namePlaza.value ="<?= $plaza['work_position']?>"
        dependency.value = "<?= $plaza['dependency']?>"
    </script>
</body>
</html>


<?php else: header("Location: ../")?>
<?php endif;?>