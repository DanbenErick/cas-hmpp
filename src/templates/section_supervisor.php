<section>
    <h1>Lista de Aplicantes</h1>
    <p class="inf">La descarga de documentos estará disponible <span>desde <?= date ('d-m-Y', strtotime ($convocatory['f_eval_cv_start']))?>  hasta  <?= date ('d-m-Y', strtotime ($convocatory['f_eval_cv_end']))?></span></p>
    <form action="index.php" id="formFilter">
        <div class="grupo">
            <?php if($workplaces != null):?>
                <select name="filter">
                    <option value="null">Elije una Opcion...</option>
                <?php foreach($workplaces as $plaza):?>
                        <?php if($plaza['id'] == $_GET['filter']):?>
                            <option value=<?= $plaza['id']?> selected>
                                <?=$plaza['cod_workplace'] . " -- "?>
                                <?=$plaza['work_position'] . " -- "?>
                                <?=$plaza['dependency']?>
                            </option>
                        <?php continue; endif;?>
                        <option value=<?= $plaza['id']?>>
                            <?=$plaza['cod_workplace'] . " -- "?>
                            <?=$plaza['work_position'] . " -- "?>
                            <?=$plaza['dependency']?>
                        </option>
                <?php endforeach;?>
                </select>
            <?php endif;?>
        </div>
    </form>
    <?php if($hoy > $convocatory['f_eval_cv_end'] && $hoy < $convocatory['f_publication_end']):?>
    <div class="list_accepted">
        <a href="lista_final.php">Lista Final</a>
    </div>
    <?php endif;?>
    <div class="contenedor-table">
        <?php if(@$_GET['filter'] == "null" || @$_GET['filter'] == null):?>
            <table>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Puesto</th>
                        <th>Documento</th>
                        <th>Evaluación</th>
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
                            <?php if($convocatory['state_eval'] != null && $convocatory['state_eval'] == 1): ?>
                                <td><a href=<?= "../files/applicants/" . $aplicante['path']?> class="documento" download=<?= $aplicante['path']?>>Descargar</a></td>
                                <td><button class="evaluacion" id="modal_evaluar" value=<?= $aplicante['id']?>>Evaluar</button></td>
                            <?php else:?>
                                <td><button class="documento" style=" background: #eee; color: #131313">Desactivado</button></td>
                                <td><button class="documento" style=" background: #eee; color: #131313">Desactivado</button></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="7">No hay postulantes aun</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        <!-- Filtro -->
        <?php else:?>
            <table>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre Completo</th>
                        <th>Telefono</th>
                        <th>Puesto</th>
                        <th>Documento</th>
                        <th>Evaluacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($resultado_aplicantes != null):?>
                        <?php foreach($resultado_aplicantes as $aplicante):?>
                            <?php if($aplicante['id_workplace'] == $_GET['filter']):?>
                                <tr>
                                    <td><?= $aplicante['dni']?></td>
                                    <td><?= $aplicante['name'] . " " . $aplicante['lastname']?></td>
                                    <td><?= $aplicante['phone']?></td>
                                    <td><?= $aplicante['work_position']?></td>
                                    <?php if($convocatory['state_eval'] != null && $convocatory['state_eval'] == 1): ?>
                                        <td><a href=<?= "../files/applicants/" . $aplicante['path']?> class="documento" download=<?= $aplicante['path']?>>Descargar</a></td>
                                        <td><button class="evaluacion" id="modal_evaluar" value=<?= $aplicante['id']?>>Evaluar</button></td>
                                    <?php else:?>
                                        <td><button class="documento" style=" background: #eee; color: #131313">Desactivado</button></td>
                                        <td><button class="documento" style=" background: #eee; color: #131313">Desactivado</button></td>
                                    <?php endif; ?>
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