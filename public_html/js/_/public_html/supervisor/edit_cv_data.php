<?php
session_start();
?>
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):?>
<?php
require("../../src/config.php");
require(PATH_CONN_DB);
$sql = "SELECT * FROM applicants WHERE id = :id";
$query = $pdo->prepare($sql);
$resultado_aplicantes = null;
$query->bindParam(":id", $_GET['id']);
if($query->execute()) {
    $resultado_aplicantes = $query->fetchAll()[0];
}
// echo "<pre>";
// var_dump($resultado_aplicantes);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segunda Etapa</title>
    <link rel="stylesheet" href="../css/style-supervisor.css">
    <style>
        th {
            width: 12.5%;
        }
        .container-edit-boton {
            width: 20px;
        }
    </style>
</head>
<body>
    <?php require(PATH_TEMPLATE  .'/nav.php');?>
    <section>
        <h1>Editar Evaluacion de CV</h1>
        <p class="inf">Se puede cambiar la calificacion y resultado</p>
        <form action="../php/edit_cv_result.php" id="formFilter" method="POST">
            <div class="grupo">
                <input type="hidden" value=<?= $_GET['id']?> name="id">
            </div>
            <div class="grupo">
                <label for="cal">Calificación</label>
                <input type="number" id="cal" name="cal" min="0" value=<?= $resultado_aplicantes['calification_cv']?>>
            </div>
            <div class="grupo">
                <label for="res">Resultado</label>
                <select name="res" id="res">
                    <?if($resultado_aplicantes['accepted'] == 1):?>
                        <option value="1" selected>ACEPTADO</option>
                        <option value="2">RECHAZADO</option>
                    <?php else: ?>
                        <option value="1">ACEPTADO</option>
                        <option value="2" selected>RECHAZADO</option>
                    <?php endif;?>
                </select>
            </div>
            <div class="grupo grupo_button">
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </section>
</body>
</html>

<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):  header("Location: ../sistema") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>