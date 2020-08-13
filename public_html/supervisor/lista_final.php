<?php
session_start();
?>
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):?>
<?php
require("../../src/config.php");
require(PATH_CONN_DB);
$sql = "SELECT workplaces.work_position, applicants.* from workplaces INNER JOIN applicants ON workplaces.id = applicants.id_workplace AND applicants.id_denomination = (SELECT MAX(id) from announcements WHERE state = 1) AND applicants.accepted = 1 ORDER BY applicants.date_time";
$query = $pdo->prepare($sql);
$resultado_aplicantes = null;
if($query->execute()) {
    $resultado_aplicantes = $query->fetchAll();
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segunda Etapa</title>
    <link rel="stylesheet" href="../css/style-supervisor.css">
</head>
<body>
    <?php require(PATH_TEMPLATE  .'/nav.php');?>
    <section>
        <h1>Segunda Etapa</h1>
        <p class="inf">Lista de Personas que Fueron Aceptadas</p>
        <div class="contenedor-table">
            <table>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre Completo</th>
                        <th>Telefono</th>
                        <th>Puesto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($resultado_aplicantes != null):?>
                        <?php foreach($resultado_aplicantes as $aplicante):?>
                        <tr>
                            <td><?= $aplicante['dni']?></td>
                            <td><?= $aplicante['name'] . " " . $aplicante['lastname']?></td>
                            <td><?= $aplicante['phone']?></td>
                            <td><?= $aplicante['work_position']?></td>
                        </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="7">No hay postulantes aun</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>

<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):  header("Location: ../sistema") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>