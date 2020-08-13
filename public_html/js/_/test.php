<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

ob_start();
require_once 'src/plantillas_reporte/reporte_final.php';
$html = ob_get_clean();
$mpdf->Bookmark('Comienzo');
$mpdf->WriteHTML($html);
$mpdf->Output();

?>