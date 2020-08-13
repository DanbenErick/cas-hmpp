<section>
        <h1>Lista de Aplicantes</h1>
        <div class="contenedor-table">
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
                    <tr>
                        <td><?= $aplicante['dni']?></td>
                        <td><?= $aplicante['name'] . " " . $aplicante['lastname']?></td>
                        <td><?= $aplicante['phone']?></td>
                        <td><?= $aplicante['work_position']?></td>
                        <td><a href=<?= "../files/applicants/" . $aplicante['path']?> class="documento" download=<?= $aplicante['path']?>>Descargar</a></td>
                        <td><button class="evaluacion" id="modal_evaluar" value=<?= $aplicante['id']?>>Evaluar</button></td>
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