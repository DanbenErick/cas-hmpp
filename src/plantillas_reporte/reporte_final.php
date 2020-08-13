<?php
    require_once("src/config.php");
    require_once(PATH_CONN_DB);

    // Datos de Convocatoria

    $sql1 = "SELECT * FROM announcements WHERE id = (SELECT MAX(id) from announcements WHERE state = 1)";
    $sql2 = "SELECT workplaces.work_position, applicants.*,
            CASE WHEN accepted = 1 Then 'ACEPTADO' WHEN accepted = 2 then 'RECHAZADO' END AS state_aplicant
            from workplaces 
            INNER JOIN applicants 
            ON workplaces.id = applicants.id_workplace
            AND
            applicants.id_denomination = (SELECT MAX(id) from announcements WHERE state = 1)
            AND
            (applicants.accepted = 1 OR applicants.accepted = 2)
            ORDER BY applicants.accepted = 2";
    $query_convocatory = $pdo->prepare($sql1);
    $query_applicant = $pdo->prepare($sql2);

    if($query_convocatory->execute()){
        $result_convocatory = $query_convocatory->fetchAll()[0];
    }
    if($query_applicant->execute()) {
        $result_applicant = $query_applicant->fetchAll();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "Reporte: ".$result_convocatory['denomination']?></title>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial;
        }
        nav {
            display: flex;
            width: 100%;
            max-width: 100%;
            /* justify-content: space-between; */
            max-height: 100px;
        }
        nav table {
            width: 100%;
            border-collapse: collapse;
        }
        img {
            width: 60px;
        }
        p {
            text-align: center;
        }
        nav td {
            text-align: center;
        }
        h1 {
            text-align: center;
        }
        th {
            background: #131313;
            color: white;
            font-weight: bold;
        }
        section table {
            border-collapse: collapse;
            font-size: 12px;
            width: 100%;
        }
        td {
            text-align: center;
        }
        section td{
            padding: 5px 4px;

            border: solid 1px #13131380;
        }
        .left {
            text-align: left;
        }
    </style>
</head>
<body>
    <nav>
        <table>
            <tbody>
                <tr>
                    <td class="contenido_1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Escudo_nacional_del_Per%C3%BA.svg/1200px-Escudo_nacional_del_Per%C3%BA.svg.png" alt="">
                    </td>
                    <td class="contenido_2">
                        <p>
                            <b>HONORABLE MUNICIPALIDAD PROVINCIAL DE PASCO</b>
                            <p>COMISIÓN DEL CONCURSO PUBLICO <span><?= $result_convocatory['denomination']?></span></p>
                        </p>
                    </td>
                    <td class="contenido_3">
                        <img src="https://www.munipasco.gob.pe/admin/source/376RR527R82742g2742703712y7u7Ru7Ru7427R037R5g2T6E5g2T6E5g2T6E2T6E.jpg" alt="">
                    </td>
                </tr>
            </tbody>
        </table>
    </nav>
    <h1>Resultado de Evaluacion de CV</h1>
    <section>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Apellidos y Nombres</th>
                    <th>EV. CV</th>
                    <th>Entrevista</th>
                    <th>Puntaje Final</th>
                    <th>Orden de Merito</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result_applicant != null):?>
                    <?php foreach($result_applicant as $aplicant): $indice= 0?>
                        <tr>
                            <td><?=$aplicant['dni']?></td>
                            <td class="left"><?=$aplicant['lastname'] . " " . $aplicant['name']?></td>
                            <td><?=$aplicant['calification_cv']?></td>
                            <td><?=$aplicant['calification_interview']?></td>
                            <td><?=($aplicant['calification_cv'] + $aplicant['calification_interview']) / 2?></td>
                            <td><?=$indice++?></td>
                            <td><?=$aplicant['state_aplicant']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay Contenido</td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
    </section>
</body>
</html>