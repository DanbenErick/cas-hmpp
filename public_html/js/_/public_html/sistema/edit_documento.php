<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1 ):
?>
<?php
    require_once("../../src/config.php");
    require_once("../php/functions/functions.php");
    $id = $_GET['id'];
    $documento = get_document_by_id($id)[0];
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
            <h1>Editar Documento</h1>
                <div class="contenedor-form">
                    <form action="../php/edit_document.php" method="POST" class="form" enctype='multipart/form-data'>
                        <div class="grupo-input">
                            <input type="hidden" name="id_documento" value=<?= $documento['id']?>>
                        </div>
                        <div class="grupo-input">
                            <label>Codigo del Documento</label>
                            <input type="text" placeholder="Codigo" name="cod_documento" id="cod">
                        </div>
                        <div class="grupo-input">
                            <label>Nombre del Documento</label>
                            <input type="text" placeholder="Nombre" name="nombre_documento" id="nameD">
                        </div>
                        <div class="grupo-input">
                            <button type="submit">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script>
        cod.value ="<?= $documento['cod_document']?>"
        nameD.value = "<?= $documento['name_document']?>"
    </script>
    <?php if(@$_GET['alert']):?>
        <script src="../js/alert.js"></script>
        <script>
            <?php
                switch($_GET['alert']) {
                    case 'fail_edit':
                        echo "failEditDocument()";
                        break;
                    case 'empty_camps':
                        echo "emptyInputs()";
                        break;
                }
            ?>
        </script>
    <?php endif;?>
</body>
</html>

<?php else: header("Location: ../")?>
<?php endif;?>
