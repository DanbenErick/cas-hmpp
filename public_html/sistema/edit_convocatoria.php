<?php
    session_start();
    if($_SESSION['id_user'] && $_SESSION['id_rol'] == 1):
?>
<?php
    require_once("../../src/config.php");
    require_once("../php/functions/functions.php");
    $datos_convocatoria = get_convocatory()[0];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Convocatoria</title>
    <link rel="stylesheet" href="../css/style-edit-con.css">
</head>
<body>
    <main>
    <section class="crear-convocatoria">
        <div class="contenedor">
            <h1>Editar Convocatoria</h1>
            <div class="contenedor-form">
                <form action="../php/edit_announcement.php" method="POST" class="form">
                    <div class="grupo-input">
                        <label>Denominacion de Convocatoria</label>
                        <input type="text" placeholder="Nominacion" name="con_nominacion" id="nameD">
                    </div>
                    <div class="separador">
                        <h2>Fecha de Publicacion de la Convocatoria</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_con" value=<?= $datos_convocatoria['f_publication']?>>
                    </div>
                    <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_con" value=<?= $datos_convocatoria['f_publication_end']?>>
                    </div>
                    <!-- <div class="grupo-input">
                        <label>Responsable</label>
                        <input type="text" placeholder="Responsable" name="con_">
                    </div> -->

                    <div class="separador">
                        <h2>Fecha de Entrega de CV</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_cv_etr" value=<?= $datos_convocatoria['f_cv_start'] ?>>
                    </div>
                    <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_cv_etr" value=<?= $datos_convocatoria['f_cv_end']?>>
                    </div>
                    <!-- <div class="grupo-input">
                        <label>Responsable</label>
                        <input type="text" placeholder="Responsable">
                    </div> -->

                    <div class="separador">
                        <h2>Fecha de Evaluacion CV</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_cv_eval" value=<?= $datos_convocatoria['f_eval_cv_start']?>>
                    </div>
                    <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_cv_eval" value=<?= $datos_convocatoria['f_eval_cv_end']?>>
                    </div>
                    <!-- <div class="grupo-input">
                        <label>Responsable</label>
                        <input type="text" placeholder="Responsable">
                    </div> -->

                    <div class="separador">
                        <h2>Fecha de Publicacion de Aptos</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Fecha</label>
                        <input type="date" placeholder="Fecha" name="con_publicacion_aptos" value=<?= $datos_convocatoria['f_publication_accepted']?>>
                    </div>

                    <div class="separador">
                        <h2>Fecha de la Entrevista Presencial</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_entrevista" value=<?= $datos_convocatoria['f_interview_start']?>>
                    </div>
                    <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_entrevista" value=<?= $datos_convocatoria['f_interview_end']?>>
                    </div>
                    <!-- <div class="grupo-input">
                        <label>Responsable</label>
                        <input type="text" placeholder="Responsable">
                    </div> -->

                    <div class="separador">
                        <h2>Etapa Final de Convocatoria</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Fecha de Publicacion de Final</label>
                        <input type="date" placeholder="Fecha" name="con_publicacion" value=<?= $datos_convocatoria['f_publication_end']?>>
                    </div>
                    <div class="grupo-input">
                        <label>Fecha de Incio de Labores</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_labores" value=<?= $datos_convocatoria['f_start_work']?>>
                    </div>
                    <div class="grupo-input">
                        <button type="submit" value="crear_con">Editar Convocatoria</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    </main>
    <script>
        nameD.value = "<?= $datos_convocatoria['denomination'] ?>";
    </script>
    <?php if(@$_GET['alert'] != null):?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="../js/alert.js"></script>
        <script>
            <?php
                switch($_GET['alert']) {
                    case 'empty_camps':
                        echo "emptyInputs()";
                        break;
                    case 'fail_edit_convocatory':
                        echo "failEditConvocatory()";
                        break;
                }
            ?>
        </script>
    <?php endif;?>
</body>
</html>


<?php else: header("Location: ../")?>
<?php endif;?>