<?php
require_once "../vista/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

if (isset($_POST['html'])) {
    $html = $_POST['html'];

    $dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnable' => true));
    $dompdf->setOptions($options);
    $dompdf->loadHtml($html);
    $dompdf->render();

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="documento.pdf"');

    $dompdf->stream("archivo_reporte.pdf", array("Attachment" => false));
    // Guarda el archivo PDF en el servidor o envíalo al navegador



}
