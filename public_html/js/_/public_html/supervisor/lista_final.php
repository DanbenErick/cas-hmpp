<?php
session_start();
?>

<!--
    Agregar las personas rechazadas
    AGREGAR UNA COLUMNA ACEPTADO O RECHAZAZADO
    ACEPTADO RECHAZADO
-->
<?php if($_SESSION['id_user'] && $_SESSION['id_rol'] == 2):?>
<?php
require("../../src/config.php");
require(PATH_CONN_DB);
$sql = "SELECT workplaces.work_position, applicants.*,
CASE
WHEN accepted = 1 Then 'ACEPTADO'
WHEN accepted = 2 then 'RECHAZADO'
END AS state_aplicant,
CASE
WHEN method = 1 Then 'VIA WEB'
WHEN method = 2 Then 'PRESENCIAL'
END AS method_aplicant
from workplaces 
INNER JOIN applicants
ON workplaces.id = applicants.id_workplace
AND
applicants.id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)
AND
(applicants.accepted = 1 OR applicants.accepted = 2)
ORDER BY applicants.datetime
";
$query = $pdo->prepare($sql);
$resultado_aplicantes = null;
if($query->execute()) {
    $resultado_aplicantes = $query->fetchAll();
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        th {
            width: calc(100% / 9);
        }
        .container-edit-boton {
            width: 20px;
        }
    </style>
</head>
<body>
    <?php require(PATH_TEMPLATE  .'/nav.php');?>
    <section>
        <h1>Segunda Etapa</h1>
        <p class="inf">Lista de Personas que Fueron Aceptadas</p>
        <form action="lista_final.php" id="formFilter">
            <div class="grupo">
                <?php if($resultado_aplicantes != null):?>
                    <select name="filter">
                        <?php if($_GET['filter'] == null || $_GET['filter'] == "null"):?>
                            <option value="null" selected>Todos</option>
                            <option value="1">ACEPTADOS</option>
                            <option value="2">RECHAZADOS</option>
                        <?php endif;?>
                        <?php if($_GET['filter'] == 1):?>
                            <option value="null">Todos</option>
                            <option value="1" selected>ACEPTADOS</option>
                            <option value="2">RECHAZADOS</option>
                        <?php endif;?>
                        <?php if($_GET['filter'] == 2):?>
                            <option value="null">Todos</option>
                            <option value="1">ACEPTADOS</option>
                            <option value="2" selected>RECHAZADOS</option>
                        <?php endif;?>
                    </select>
                <?php endif;?>
            </div>
        </form>
        <div class="contenedor-table">
            <?php if(@$_GET['filter'] == "null" || @$_GET['filter'] == null):?>
                <table>
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre Completo</th>
                            <th>Eval CV</th>
                            <th class="container-edit-boton"></th>
                            <th>Eval Entrevista</th>
                            <th class="container-edit-boton"></th>
                            <th>Cargo</th>
                            <th>Estado</th>
                            <th>Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($resultado_aplicantes != null):?>
                            <?php foreach($resultado_aplicantes as $aplicante): $id = $aplicante['id']?>
                            <tr>
                                <td><?= $aplicante['dni']?></td>
                                <td><?= $aplicante['name'] . " " . $aplicante['lastname']?></td>
                                <td><?= $aplicante['calification_cv']?></td>
                                <td><a href=<?= "edit_cv_data.php?id=".$id?> class="icon-pencil"></a></td>
                                <?php if($aplicante['calification_interview']):?>
                                    <td>
                                        <?= $aplicante['calification_interview']?>
                                    </td>
                                    <td>
                                        <a href=<?= "edit_interview_data.php?id=".$id ?> class="icon-pencil"></a>
                                    </td>
                                <?php else :?>
                                    <td>
                                        <input type='text' id=<?='data_interview_'.$id?> placeholder='Calificacion' />
                                    </td>
                                    <td>
                                        <a href="#" class="icon-check">
                                            <input type="hidden" value=<?= $id?>>
                                        </a>
                                    </td>
                                <?php endif;?>

                                <td><?= $aplicante['work_position']?></td>
                                <td><?= $aplicante['state_aplicant']?></td>
                                <td><?= $aplicante['method_aplicant']?></td>
                            </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="7">No hay postulantes aun</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            <?php else:?>
                <table>
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre Completo</th>
                            <th>Eval CV</th>
                            <th class="container-edit-boton"></th>
                            <th>Eval Entrevista</th>
                            <th class="container-edit-boton"></th>
                            <th>Cargo</th>
                            <th>Estado</th>
                            <th>Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($resultado_aplicantes != null):?>
                            <?php foreach($resultado_aplicantes as $aplicante): $id = $aplicante['id']?>
                            <?php if($aplicante['accepted'] == $_GET['filter']):?>
                                <tr>
                                    <td><?= $aplicante['dni']?></td>
                                    <td><?= $aplicante['name'] . " " . $aplicante['lastname']?></td>
                                    <td><?= $aplicante['calification_cv']?></td>
                                    <td><a href=<?= "edit_cv_data.php?id=".$id?> class="icon-pencil"></a></td>
                                    <?php if($aplicante['calification_interview']):?>
                                        <td>
                                            <?= $aplicante['calification_interview']?>
                                        </td>
                                        <td>
                                            <a href=<?= "edit_interview_data.php?id=".$id ?> class="icon-pencil"></a>
                                        </td>
                                    <?php else :?>
                                        <td>
                                            <input type='text' id=<?='data_interview_'.$id?> placeholder='Calificacion' />
                                        </td>
                                        <td>
                                            <a href="#" class="icon-check">
                                                <input type="hidden" value=<?= $id?>>
                                            </a>
                                        </td>
                                    <?php endif;?>

                                    <td><?= $aplicante['work_position']?></td>
                                    <td><?= $aplicante['state_aplicant']?></td>
                                    <td><?= $aplicante['method_aplicant']?></td>
                                </tr>
                            <?php endif;?>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="7">No hay postulantes aun</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            <?php endif;?>
        </div>
    </section>
    <script src="../js/alert.js"></script>
    <script>
    formFilter.addEventListener("change", function(e) {
        e.preventDefault()
        console.log(e.target.value)
        window.location = `./lista_final.php?filter=${e.target.value}`
    })
    let botonesAdd = document.querySelectorAll(".icon-check")
    botonesAdd.forEach(item => {
        item.addEventListener("click", function(e) {
            e.preventDefault()
            let id = item.querySelector("input").value
            let valor = document.querySelector(`#data_interview_${id}`).value
            window.location = `../php/edit_interview_result.php?id=${id}&eval=${valor}`
        })
    })
    <?php
        if(@$_GET['alert'] !=  null) {
            switch($_GET['alert']){
                case 'success_accept':
                    echo "successAccept()";
                    break;
                case 'error_accept':
                    echo "errorAccept()";
                    break;
                case 'success_decline':
                    echo "successDecline()";
                    break;
                case 'error_decline':
                    echo "errorDecline()";
                    break;
            }
        }
    ?>
</script>
</body>
</html>

<?php elseif($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):  header("Location: ../sistema") ?>
<?php else: header("Location: ../") ?>
<?php endif;?>