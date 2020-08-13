<?php


?>
<?php if($ruta_section == "convocatoria"): ?>
    <section class="crear-convocatoria">
        <div class="contenedor">
            <h1>Crear Convocatoria</h1>
            <div class="contenedor-form">
                <form action="../php/reg_convocatoria.php" method="POST" class="form">
                    <div class="grupo-input">
                        <label>Nominacion de Convocatoria</label>
                        <input type="text" placeholder="Nominacion" name="con_nominacion">
                    </div>


                    <div class="separador">
                        <h2>Fecha de Publicacion de la Convocatoria</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_con">
                    </div>
                    <!-- <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_con">
                    </div> -->

                    <div class="separador">
                        <h2>Fecha de Entrega de CV</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_cv_etr">
                    </div>
                    <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_cv_etr">
                    </div>
                    <div class="separador">
                        <h2>Fecha de Evaluacion CV</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_cv_eval">
                    </div>
                    <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_cv_eval">
                    </div>
                    <div class="separador">
                        <h2>Fecha de Publicacion de Aptos</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Fecha</label>
                        <input type="date" placeholder="Fecha" name="con_publicacion_aptos">
                    </div>

                    <div class="separador">
                        <h2>Fecha de la Entrevista Presencial</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Inicio</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_entrevista">
                    </div>
                    <div class="grupo-input">
                        <label>Fin</label>
                        <input type="date" placeholder="Fecha" name="con_fin_entrevista">
                    </div>
                    <div class="separador">
                        <h2>Etapa Final de Convocatoria</h2>
                    </div>
                    <div class="grupo-input">
                        <label>Fin de Convocatoria y Fecha de Publicacion de Resultado Final</label>
                        <input type="date" placeholder="Fecha" name="con_publicacion">
                    </div>
                    <div class="grupo-input">
                        <label>Fecha de Incio de Labores</label>
                        <input type="date" placeholder="Fecha" name="con_inicio_labores">
                    </div>
                    <div class="grupo-input">
                        <button type="submit" name="crear_con" value="crear_con">Crear Convocatoria</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php if($ruta_section == "documento"): ?>
        <section class="crear-documento">
            <div class="contenedor">
                <h1>Crear Documento</h1>
                <div class="contenedor-form">
                    <form action="../php/reg_documento.php" method="POST" class="form" enctype='multipart/form-data'>
                        <div class="grupo-input">
                            <label>Codigo del Documento</label>
                            <input type="text" placeholder="Codigo" name="cod_documento">
                        </div>
                        <div class="grupo-input">
                            <label>Nombre del Documento</label>
                            <input type="text" placeholder="Nombre" name="nombre_documento">
                        </div>
                        <div class="grupo-input">
                            <label for="file-documento" class="file-label"><p>Subir Archivo</p><span>Formato: PDF</span></label>
                            <input  type="file" name="ruta_documento" id="file-documento" accept=".pdf" />
                            <span>Archivo Seleccionado es: <span id="name"></span></span>
                        </div>
                        <div class="grupo-input">
                            <button type="submit">Crear Documento</button>
                        </div>
                    </form>
                </div>
                <h1>Lista de Documentos</h1>
                <div class="contenedor-table">
                    <table class="tabla-documentos">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th></th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($table_documents != null):?>
                                <?php foreach($table_documents as $data):?>
                                    <tr>
                                        <td><?= $data['cod_document']?></td>
                                        <td class="t_buttons">
                                            <a href=<?= "edit_documento.php?id=".$data['id']?> class="icon-pencil"></a>
                                            <a href=<?= "../php/delete_document.php?id=".$data['id'] ?> class="icon-trash btn_delete"></a>
                                        </td>
                                        <td><?= $data['name_document']?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="3">No hay contenido que mostrar</td>
                                </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
<?php endif;?>


<?php if($ruta_section == "plaza"):?>
    <section class="crear-plaza">
            <div class="contenedor">
                <h1>Crear Plaza</h1>
                <div class="contenedor-form">
                    <form action="../php/reg_plaza.php" method="POST" class="form">
                        <div class="grupo-input">
                            <label>Codigo de la Plaza</label>
                            <input type="text" placeholder="Codigo" name="cod_plaza">
                        </div>
                        <div class="grupo-input">
                            <label>Nombre de la Plaza</label>
                            <input type="text" placeholder="Nombre" name="nombre_plaza">
                        </div>
                        <div class="grupo-input">
                            <label>Dependencia</label>
                            <input type="text" placeholder="Dependencia" name="dependencia_plaza">
                        </div>
                        <div class="grupo-input">
                            <button type="submit" name="crear_plaza" value="crear_plaza">Crear Plaza</button>
                        </div>
                    </form>
                </div>
                <h1>Lista de Plazas</h1>
                <!-- <div class="contenedor-form">
                    <form action="" class="form form-buscador-documentos">
                        <div class="grupo-input">
                            <input type="text" placeholder="Buscar.." id="searchWorkplace"/>
                            <button class="icon-search"></button>
                        </div>
                    </form>
                </div> -->
                <div class="contenedor-table">
                    <table class="tabla-documentos">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th></th>
                                <th>Nombre</th>
                                <th>Dependencia</th>
                            </tr>
                        </thead>
                        <tbody id="table_content_workplaces">
                            <?php if($table_plazas != null):?>
                                <?php foreach($table_plazas as $data):?>
                                    <tr>
                                        <td class="work_position"><?= $data['cod_workplace'] ?></td>
                                        <td class="t_buttons">
                                            <a href=<?= "edit_plaza.php?id=".$data['id'] ?> class="icon-pencil"></a>
                                            <a href=<?= "../php/delete_workplace.php?id=".$data['id'] ?> class="icon-trash btn_delete"></a>
                                        </td>
                                        <td class="work_position"><?= $data['work_position'] ?></td>
                                        <td class="work_position"><?= $data['dependency'] ?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="3">No hay plazas que mostrar</td>
                                </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
<?php endif;?>


<?php if($ruta_section == "lista-convocatoria"):?>
    <section class="lista_convocatoria">
        <div class="contenedor">
            <h1>Lista de Convocatorias</h1>
            <!-- <div class="contenedor-form">
                <form action="" class="form form-buscador-documentos">
                    <div class="grupo-input">
                        <input type="text" placeholder="Buscar.." />
                        <button class="icon-search"></button>
                    </div>
                </form>
            </div> -->
            <div class="contenedor-table">
                <table class="tabla-documentos">
                    <thead>
                        <tr>
                            <th>Denominacion</th>
                            <th></th>
                            <th>Fecha de Publicacion</th>
                            <th>Fecha de Conclusion</th>
                            <th>Fin de Entrega de CV</th>
                            <th>Ultimo dia Entrega de CV</th>
                            <th>Comienzo de Evaluacion</th>
                            <th>Final de Evaluacion</th>
                            <th>Segunda Etapa</th>
                            <th>Comienzo Entrevista</th>
                            <th>Fin de Entrevista</th>
                            <th>Incio de Labores</th>
                        </tr>
                    </thead>
                    <tbody id="content_table_convocatory">
                        <?php if($table_convocatory != null):?>
                            <?php foreach($table_convocatory as $data):?>
                                <tr>
                                    <td><?= $data['denomination'] ?></td>
                                    <td class="t_buttons">
                                        <a href=<?= "edit_convocatoria.php"?> class="icon-pencil"></a>
                                        <a href=<?= "../php/delete_announcement.php?id=".$data['id'] ?> class="icon-trash btn_delete"></a>
                                    </td>
                                    <td><?= $data['f_publication']?></td>
                                    <td><?= $data['f_publication_end']?></td>
                                    <td><?= $data['f_cv_start']?></td>
                                    <td><?= $data['f_cv_end']?></td>
                                    <td><?= $data['f_eval_cv_start']?></td>
                                    <td><?= $data['f_eval_cv_end']?></td>
                                    <td><?= $data['f_publication_accepted']?></td>
                                    <td><?= $data['f_interview_start']?></td>
                                    <td><?= $data['f_interview_end']?></td>
                                    <td><?= $data['f_start_work']?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr>
                                <td colspan="20">No hay Convocatorias que Mostrar que mostrar</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php endif;?>

<button id="btn_action" class="icon-menu"></button>
<script src="../js/script.js"></script>
