<?php 
header('Content-type: application/pdf');
 $rutaArchivo = $_POST['ruta'];
 $nombreArchivo = $_POST['nombreArchivo'];

use setasign\Fpdi\Fpdi; 
require_once('../vendor/autoload.php');

// Source file and watermark config 
$text_image = '../img/marcaAgua1.png'; 
 
// Set source PDF file 
$pdf = new Fpdi(); 

if(file_exists($rutaArchivo)){ 
     $pagecount = $pdf->setSourceFile($rutaArchivo); 
}else{ 
    die('Archivo no encontrado'); 
} 
 
// Add watermark image to PDF pages 
for($i=1;$i<=$pagecount;$i++){ 

     $tpl = $pdf->importPage($i); 
    $size = $pdf->getTemplateSize($tpl); 
    $pdf->addPage(); 
    $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE); 
     
    //Put the watermark 
    $xxx_final = ($size['width']-60); 
    $yyy_final = ($size['height']-25); 
    $pdf->Image($text_image, $xxx_final, $yyy_final, 0, 0, 'png'); 
} 


// Output PDF with watermark 
$pdf->Output('D', 'prueba', true);
exit();