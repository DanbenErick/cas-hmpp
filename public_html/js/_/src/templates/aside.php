<aside id="aside">
    <?php if($ruta_section == "convocatoria"): ?>
        <ul>
            <li><a href="index.php" class=<?= $ruta_section?>>Crear Convocatoria</a></li>
            <li><a href="lista_convocatoria.php">Lista Convocatoria</a></li>
            <li><a href="documentos.php">Documentos</a></li>
            <li><a href="plaza.php">Plazas</a></li>
            <li><a href="../admin">Usuarios</a></li>
            <li><a href="../php/generate_result_cv.php">Generar retultado CV</a></li>
            <li><a href="../php/generate_result_end.php">Generar resultado Final</a></li>
        </ul>
<?php endif; ?>
<?php if($ruta_section == "documento"): ?>
        <ul>
            <li><a href="index.php">Crear Convocatoria</a></li>
            <li><a href="lista_convocatoria.php">Lista Convocatoria</a></li>
            <li><a href="documentos.php" class=<?= $ruta_section?>>Documentos</a></li>
            <li><a href="plaza.php">Plazas</a></li>
            <li><a href="../admin">Usuarios</a></li>
            <li><a href="../php/generate_result_cv.php">Generar retultado CV</a></li>
            <li><a href="../php/generate_result_end.php">Generar resultado Final</a></li>
        </ul>
<?php endif; ?>
<?php if($ruta_section == "plaza"): ?>
        <ul>
            <li><a href="index.php">Crear Convocatoria</a></li>
            <li><a href="lista_convocatoria.php">Lista Convocatoria</a></li>
            <li><a href="documentos.php">Documentos</a></li>
            <li><a href="plaza.php" class=<?= $ruta_section?>>Plazas</a></li>
            <li><a href="../admin">Usuarios</a></li>
            <li><a href="../php/generate_result_cv.php">Generar retultado CV</a></li>
            <li><a href="../php/generate_result_end.php">Generar resultado Final</a></li>
        </ul>
<?php endif; ?>
<?php if($ruta_section == "lista-convocatoria"): ?>
        <ul>
            <li><a href="index.php">Crear Convocatoria</a></li>
            <li><a href="lista_convocatoria.php" class="documento">Lista Convocatoria</a></li>
            <li><a href="documentos.php">Documentos</a></li>
            <li><a href="plaza.php">Plazas</a></li>
            <li><a href="../admin">Usuarios</a></li>
            <li><a href="../php/generate_result_cv.php">Generar retultado CV</a></li>
            <li><a href="../php/generate_result_end.php">Generar resultado Final</a></li>
        </ul>
<?php endif; ?>
</aside>
