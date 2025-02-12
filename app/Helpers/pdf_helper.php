<?php
use Dompdf\Dompdf;
use Dompdf\Options;

function generatePDF($html, $filename = "reporte.pdf")
{
    $options = new Options();
    $options->set('defaultFont', 'Helvetica');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename, ["Attachment" => false]);
}
