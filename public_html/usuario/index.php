<?php if(@!$_SESSION['id_user'] && @!$_SESSION['id_rol']): ?>
    <?php
        $resultado_documents = null;
        $resultado_fechas = null;
        $resultado_documents = get_documents_users();
        $resultado_fechas = get_fechas_convocatoria()[0];
        $state_etr = $resultado_fechas['state_etr'];
        $plazas_disponibles = get_workplaces_users();
        $hoy = date("Y-m-d");
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Formatos</title>
    <link rel="stylesheet" href="public_html/css/style-list.css?v=1">
</head>
<body>
    <header class="header_logo">
        <div>
            <img src="public_html/img/logo.png" alt="">
            <div class="contenedor_header_inf">
                <div class="container">
                    <span>Dirección</span>
                    <p>Jr. San Cristobal S/N, Plazuela Municipal - Chaupimarca - Cerro de Pasco</p>
                </div>
                <div class="container">
                    <span>Horario de Atención</span>
                    <p><b>Mañanas:</b> 08:30 a.m. - 12:15 m.</p>
                    <p><b>Tardes:</b> 02:30 p.m. - 05:30 p.m.</p>
                </div>
            </div>
        </div>
    </header>
    <section>
        <header>
            <h2><?= @$resultado_fechas['denomination'] != null ? $resultado_fechas['denomination']: "Aún no hay convocatoria que mostrar"?></h2>
        </header>
        <div class="contenedor_table contenedor_table_1">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Formato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(@$resultado_documents != null):?>
                        <?php foreach($resultado_documents as $data):?>
                            <tr>
                                <td><?= $data['name_document']?></td>
                                <td><a href=<?= "public_html/files/".$data['path_document'].".pdf"?> download=<?= urlencode($data['name_document']).".pdf"?>>Descargar</a></td>
                            </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="3">No hay Contenido que mostrar</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
        <?php if($state_etr != null && $state_etr == 1):?>
            <div class="container_btn">
                <a href="public_html/usuario/postular.php" class="btn_postular">POSTULAR A CONVOCATORIA</a>
            </div>
            <div class="inf_file">
                <h2>Solo se admite (1) archivo en formato pdf, rar ó zip.</h2>
            </div>
        <?php endif;?>
        <?php if( @$resultado_fechas['denomination'] != null):?>
            <header class="second" style="margin-top: 20px">
                <h2>CRONOGRAMA</h2>
            </header>
            <div class="contenedor_table contenedor_table_2">
                <table>
                    <thead>
                        <tr>
                            <th>Etapa</th>
                            <th>Comienza</th>
                            <th>Finaliza</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(@$resultado_fechas != ""):?>
                        <tr>
                            <td>Apertura de Convocatoria</td>
                            <td class="fechas"><?= $resultado_fechas['f_publication']?></td>
                            <td class="fechas"><?= $resultado_fechas['f_publication_end']?></td>
                        </tr>
                        <tr>
                            <td>Entrega de CV</td>
                            <td class="fechas"><?= $resultado_fechas['f_cv_start']?></td>
                            <td class="fechas"><?= $resultado_fechas['f_cv_end']?></td>
                        </tr>
                        <tr>
                            <td>Evaluacion de CV</td>
                            <td class="fechas"><?= $resultado_fechas['f_eval_cv_start']?></td>
                            <td class="fechas"><?= $resultado_fechas['f_eval_cv_end']?></td>
                        </tr>
                        <tr>
                            <td>Fecha de Publicacion (Segunda Etapa)</td>
                            <td class="fechas"><?= $resultado_fechas['f_publication_accepted']?></td>
                            <td class="fechas"><?= $resultado_fechas['f_publication_accepted']?></td>
                        </tr>
                        <tr>
                            <td>Entrevista Personal</td>
                            <td class="fechas"><?= $resultado_fechas['f_interview_start']?></td>
                            <td class="fechas"><?= $resultado_fechas['f_interview_end']?></td>
                        </tr>
                        <tr>
                            <td>Resultado Final</td>
                            <td class="fechas"><?= $resultado_fechas['f_publication_end']?></td>
                            <td class="fechas"><?= $resultado_fechas['f_publication_end']?></td>
                        </tr>
                        <tr>
                            <td>Incio de Labores</td>
                            <td class="fechas"><?= $resultado_fechas['f_start_work']?></td>
                            <td class="fechas"><?= $resultado_fechas['f_start_work']?></td>
                        </tr>
                        <?php else:?>
                            <tr>
                                <td colspan="3">No hay Contenido que mostrar</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        <?php endif;?>
    </section>
    <script src="public_html/js/moment.js"></script>
    <script>
        moment.defineLocale('es', {
            months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
            weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
            weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
            weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
        })

        let fechas = document.querySelectorAll(".fechas")
        fechas.forEach( valor => {
            valor.textContent = moment(valor.textContent).format('DD MMMM YYYY')
        })
    </script>
</body>
</html>
<?php else: header("Location: ../")?>
<?php endif;?>