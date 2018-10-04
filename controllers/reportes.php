<?php
session_start();
require_once("../modelos/Reportes.php");
require_once("fpdf/fpdf.php");
require_once("fpdf/config.php");

$report = new Reportes();

/*INICIALIZO VARIABLES*/

$idrequest=isset($_POST['idrequest'])? limpiarCadena($_POST['idrequest']):"";

$idrequest_temp=isset($_POST['idrequest_temp'])? limpiarCadena($_POST['idrequest_temp']):"";

$bdDepartamento=isset($_POST['bdDepartamento'])? limpiarCadena($_POST['bdDepartamento']):"";

$bdReq=isset($_POST['bdReq'])? limpiarCadena($_POST['bdReq']):"";

$idodc=isset($_POST['idodc'])? limpiarCadena($_POST['idodc']):"";


switch ($_GET["op"]){

    case 'reportRequisicion':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        if ($idrequest != ""){
            $formato = $report->dataFormato(1);
            $codigo = $formato['codigo'];
            $fechaf = $formato['fecha'];
            $titulo = $formato['titulo'];
            $revision = $formato['revision'];

            $numReq = $report->numReq($idrequest_temp, $bdDepartamento);
            $dataReq = $report->mostrarRequest($idrequest_temp);

            $pdf = new PDF($codigo,$dataReq['responsable'],$dataReq['supervisor'],$dataReq['fecha'],$fechaf,$titulo,$revision);

            $pdf->AddPage();
            // FIJAMOS EL COLOR PARA TODOS LOS RELLENOS
            $pdf->SetFillColor(198, 198, 247);

            $pdf->SetXY(10,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(96,5,'SERVICIO', 1, 0, 'C');

            $pdf->SetXY(76,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(5,5,($dataReq['servicio'] != 1 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(106,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(96,5,'MATERIALES', 1, 0, 'C');

            $pdf->SetXY(174,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(5,5,($dataReq['servicio'] != 0 ) ? '': 'X' , 1, 0, 'C');
            // FILA 

            $pdf->SetXY(10,47);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(192,4,'DATOS BASICOS', 1, 0, 'C',true);

            $pdf->SetXY(10,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,utf8_decode('Nº REQUISICION'), 1, 0, 'C', true);

            $pdf->SetXY(58,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'DEPARTAMENTO O AREA', 1, 0, 'C', true);

            $pdf->SetXY(106,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'PRIORIDAD', 1, 0, 'C', true);

            $pdf->SetXY(154,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'CERTIFICADO DE CALIDAD', 1, 0, 'C', true);

            // FILA

            $pdf->SetXY(10,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,$numReq['codigo'], 1, 0, 'C');

            $pdf->SetXY(58,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,$dataReq['dpto'], 1, 0, 'C');

            $pdf->SetXY(106,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'', 1, 0, 'C');
//
            $pdf->SetXY(117,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 3 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(106,55);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'CRITICO', 0, 0, 'L');

            $pdf->SetXY(132,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 2 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(124,55);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'URGENTE', 0, 0, 'C');

            $pdf->SetXY(147,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 1 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(138,55);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'NORMAL', 0, 0, 'C');

            $pdf->SetXY(178,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(24,4,'NO', 1, 0, 'C');

            $pdf->SetXY(154,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(24,4,'SI', 1, 0, 'C');

            $pdf->SetXY(170,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['calidad'] != 2 ) ? '': 'X', 1, 0, 'C');

            $pdf->SetXY(194,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['calidad'] != 1 ) ? '': 'X', 1, 0, 'C');

            // FILA

            $pdf->SetXY(10,59);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,utf8_decode('Nº ORDEN DE SERVICIO'), 1, 0, 'C', true);

            $pdf->SetXY(10,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'', 1, 0, 'C');

            $pdf->SetXY(58,59);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(72,4,'NOMBRE DE LA EMBARCACION', 1, 0, 'C', true);

            $pdf->SetXY(58,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(72,4,$dataReq['nombre'], 1, 0, 'C');

            $pdf->SetXY(130,59);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(72,4,'TIPO DE MANTENIMIENTO', 1, 0, 'C', true);

            $pdf->SetXY(130,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(72,4,'', 1, 0, 'C');

            $pdf->SetXY(166,63);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(36,4,'PREVENTIVO', 0, 0, 'L');

            $pdf->SetXY(130,63);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(36,4,'CORRECTIVO', 0, 0, 'L');

            $pdf->SetXY(160,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['calidad'] != 1 ) ? '': 'X', 1, 0, 'C');

            $pdf->SetXY(194,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['calidad'] != 2 ) ? '': 'X', 1, 0, 'C');

            $pdf->SetXY(10,69);
            
            $rsptaitem = $report->mostrarItems($idrequest_temp);
            $header = array('ITEM', 'DESCRIPCION','CANTIDAD','UNIDAD DE MEDIDA');
            $pdf->tablaReq($header,$rsptaitem);

            $pdf->ln();
            $x = $pdf->getX();
            $y = $pdf->getY();

            $pdf->SetXY($x,$y+2);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(192,5,'OBSERVACIONES', 1, 0, 'C', true);

            $pdf->SetXY($x,$y+7);
            $pdf->MultiCell(192,20,$dataReq['comentario'], 'LRB', 'L', 0);
            $x = $pdf->getX();
            $y = $pdf->getY();

            $pdf->SetXY($x,$y);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(192,5,'PROVEEDOR SELECCIONADO', 'LRT', 0, 'C', true);
            $pdf->SetXY($x,$y+5);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(192,5,'(SOLO PARA SER UTILIZADO POR EL GERENTE DE ADMINISTRACION)', 'LRB', 0, 'C', true);

            $pdf->SetXY($x,$y+10);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(192,15,'', 1, 0, 'C');
            $pdf->ln();

            /*NOMBRE ARCHIVO*/
            $narchivo = 'RQ_'.round(microtime(true));
            
            //$pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/req/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/req/'.$narchivo.'.pdf';
            echo $ruta;
            
        }
        else {
            echo "No se puede generar el reporte solicitado, faltan datos por completar";
        }
    break;

    case 'reportOC':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        if ($idodc != ""){
            $formato = $report->dataFormato(2);
            $codigo = $formato['codigo'];
            $fechaf = $formato['fecha'];
            $titulo = $formato['titulo'];
            $revision = $formato['revision'];

            $numReq = $report->numReq($idrequest_temp, $bdDepartamento);

            $dataReq = $report->mostrarRequest($idrequest_temp);

            $dataOC = $report->mostrarOC($idodc,$bdDepartamento,$bdReq);

            $pdf = new PDF($codigo,$dataReq['responsable'],$dataReq['supervisor'],$dataReq['fecha'],$fechaf,$titulo,$revision);

            $pdf->AddPage();
            // FIJAMOS EL COLOR PARA TODOS LOS RELLENOS
               $pdf->SetFillColor(198, 198, 247);

               $pdf->SetXY(10,42);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(44,5,utf8_decode('Nº ORDEN DE COMPRA'), 1, 0, 'C', true);

               $pdf->SetXY(54,42);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(44,5,utf8_decode('Nº REQUISICION'), 1, 0, 'C', true);

               $pdf->SetXY(98,42);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(82,5,'NOMBRE DEL PROVEEDOR', 1, 0, 'C', true);

               $pdf->SetXY(180,42);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(22,5,'FECHA', 1, 0, 'C', true);

//             FILA 

                $pdf->SetXY(10,47);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(44,5,'DATOS BASICOS', 1, 0, 'C');

                $pdf->SetXY(54,47);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(44,5,utf8_decode('Nº REQUISICION'), 1, 0, 'C');

                $pdf->SetXY(98,47);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(82,5,'NOMBRE DEL P', 1, 0, 'C');

                $pdf->SetXY(180,47);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(22,5,'', 1, 0, 'C');

//             FILA

               $pdf->SetXY(10,52);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(88,5,'CONDICIONES DE ENTREGA', 1, 0, 'C', true);

               $pdf->SetXY(98,52);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(68,5,'LUGAR Y FECHA DE ENTREGA', 1, 0, 'C', true);

               $pdf->SetXY(166,52);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(36,5,'CONDICIONES DE PAGO', 1, 0, 'C', true);

//             FILA

               $pdf->SetXY(10,57);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(88,18,'', 1, 0, 'C');

               $pdf->SetXY(98,57);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(68,18,'', 1, 0, 'C');

               $pdf->SetXY(166,57);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(36,18,'', 1, 0, 'C');

//             FILA

               $pdf->SetXY(10,75);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(145,10,'LE SOLICITAMOS LOS SIGUIENTES PRODUCTOS, CUYOS PRECIOS CORRESPONDEN AL', 1, 0, 'C', true);


               $pdf->SetXY(155,75);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(24,4,utf8_decode('Nº COTIZACION'), 1, 0, 'C', true);

               $pdf->SetXY(155,79);
               $pdf->SetFont('Arial','B',5);
               $pdf->Cell(24,6,utf8_decode(''), 1, 0, 'C');

               $pdf->SetXY(179,75);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(23,4,utf8_decode('FECHA'), 1, 0, 'C', true);

               $pdf->SetXY(179,79);
               $pdf->SetFont('Arial','B',5);
               $pdf->Cell(23,6,utf8_decode(''), 1, 0, 'C');
// FILA
               $pdf->SetXY(10,85);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(10, 14.8, 'ITEM', 1, 'C', true);

               $pdf->SetXY(20,85);
               $pdf->MultiCell(20, 14.8, 'CANTIDAD', 1, 'C', true);

               $pdf->SetXY(40,85);
               $pdf->SetFont('Arial','B',5);
               $pdf->MultiCell(20, 14.8, 'UNIDAD DE MEDIDA', 1, 'C', true);

               $pdf->SetXY(60,85);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(95, 4, 'DESCRIPCION DEL PRODUCTO', 'LTR', 'C', true);

               $pdf->SetXY(60,89);
               $pdf->SetFont('Arial','',5);
               $pdf->MultiCell(95, 2, '(TIPO, REFERENCIA, MODELO,CLASE,GRADO,CARACTERISTICAS', 'LR', 'C', true);

               $pdf->SetXY(60,91);
               $pdf->MultiCell(95, 2, '(TECNICAS,PLANOS,ESQUEMAS,ESPECIFICACIONES,REQUISITOS DEL PROCESO Y', 'LR', 'C', true);

               $pdf->SetXY(60,93);
               $pdf->MultiCell(95, 2, 'CUALQUIER OTRA DESCRIPCION)', 'LR', 'C', true);

               $pdf->SetXY(60,95);
               $pdf->MultiCell(95, 4.8, '', 'LRB', 'C', true);

               $pdf->SetXY(155,85);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(24, 14.8, 'VALOR UNITARIO', 1, 'C', true);

               $pdf->SetXY(179,85);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(23, 14.8, 'VALOR TOTAL', 1, 'C', true);

               $pdf->ln();
               $x = $pdf->getX();
               $y = $pdf->getY();
   
               $pdf->SetXY($x,$y+2);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(169,5,'Sub-Total', 'LTR', 0, 'R');

               $pdf->SetXY($x+169,$y+2);
               $pdf->Cell(23,5,'', 1, 0, 'R');

               $pdf->SetXY($x,$y+7);
               $pdf->Cell(169,5,'IVA 16 %', 'LR', 0, 'R');
               $pdf->SetXY($x+169,$y+7);
               $pdf->Cell(23,5,'', 1, 0, 'R');

               $pdf->SetXY($x,$y+12);
               $pdf->Cell(169,5,'Total', 'LR', 0, 'R');
               $pdf->SetXY($x+169,$y+12);
               $pdf->Cell(23,5,'', 1, 0, 'R');

               $pdf->SetXY($x,$y+17);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(192,5,'REQUISITOS DE CALIDAD', 1, 0, 'C', true);

               $pdf->ln();

               

//             $pdf->SetXY(117,55);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(3,4,($dataReq['prioridad'] != 3 ) ? '': 'X' , 1, 0, 'C');

//             $pdf->SetXY(106,55);
//             $pdf->SetFont('Arial','B',6);
//             $pdf->Cell(5,4,'CRITICO', 0, 0, 'L');

//             $pdf->SetXY(132,55);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(3,4,($dataReq['prioridad'] != 2 ) ? '': 'X' , 1, 0, 'C');

//             $pdf->SetXY(124,55);
//             $pdf->SetFont('Arial','B',6);
//             $pdf->Cell(5,4,'URGENTE', 0, 0, 'C');

//             $pdf->SetXY(147,55);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(3,4,($dataReq['prioridad'] != 1 ) ? '': 'X' , 1, 0, 'C');

//             $pdf->SetXY(138,55);
//             $pdf->SetFont('Arial','B',6);
//             $pdf->Cell(5,4,'NORMAL', 0, 0, 'C');

//             $pdf->SetXY(178,55);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(24,4,'NO', 1, 0, 'C');

//             $pdf->SetXY(154,55);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(24,4,'SI', 1, 0, 'C');

//             $pdf->SetXY(170,55);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(3,4,($dataReq['calidad'] != 2 ) ? '': 'X', 1, 0, 'C');

//             $pdf->SetXY(194,55);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(3,4,($dataReq['calidad'] != 1 ) ? '': 'X', 1, 0, 'C');

//             // FILA

//             $pdf->SetXY(10,59);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(48,4,utf8_decode('Nº ORDEN DE SERVICIO'), 1, 0, 'C', true);

//             $pdf->SetXY(10,63);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(48,4,'', 1, 0, 'C');

//             $pdf->SetXY(58,59);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(72,4,'NOMBRE DE LA EMBARCACION', 1, 0, 'C', true);

//             $pdf->SetXY(58,63);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(72,4,$dataReq['nombre'], 1, 0, 'C');

//             $pdf->SetXY(130,59);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(72,4,'TIPO DE MANTENIMIENTO', 1, 0, 'C', true);

//             $pdf->SetXY(130,63);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(72,4,'', 1, 0, 'C');

//             $pdf->SetXY(166,63);
//             $pdf->SetFont('Arial','B',6);
//             $pdf->Cell(36,4,'PREVENTIVO', 0, 0, 'L');

//             $pdf->SetXY(130,63);
//             $pdf->SetFont('Arial','B',6);
//             $pdf->Cell(36,4,'CORRECTIVO', 0, 0, 'L');

//             $pdf->SetXY(160,63);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(3,4,($dataReq['calidad'] != 1 ) ? '': 'X', 1, 0, 'C');

//             $pdf->SetXY(194,63);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(3,4,($dataReq['calidad'] != 2 ) ? '': 'X', 1, 0, 'C');

//             $pdf->SetXY(10,69);
            
//             $rsptaitem = $report->mostrarItems($idrequest_temp);
//             $header = array('ITEM', 'DESCRIPCION','CANTIDAD','UNIDAD DE MEDIDA');
//             $pdf->tablaReq($header,$rsptaitem);

//             $pdf->ln();
//             $x = $pdf->getX();
//             $y = $pdf->getY();

//             $pdf->SetXY($x,$y+2);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(192,5,'OBSERVACIONES', 1, 0, 'C', true);

//             $pdf->SetXY($x,$y+7);
//             $pdf->MultiCell(192,20,$dataReq['comentario'], 'LRB', 'L', 0);
//             $x = $pdf->getX();
//             $y = $pdf->getY();

//             $pdf->SetXY($x,$y);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(192,5,'PROVEEDOR SELECCIONADO', 'LRT', 0, 'C', true);
//             $pdf->SetXY($x,$y+5);
//             $pdf->SetFont('Arial','B',6);
//             $pdf->Cell(192,5,'(SOLO PARA SER UTILIZADO POR EL GERENTE DE ADMINISTRACION)', 'LRB', 0, 'C', true);

//             $pdf->SetXY($x,$y+10);
//             $pdf->SetFont('Arial','B',8);
//             $pdf->Cell(192,15,'', 1, 0, 'C');
//             $pdf->ln();

            /*NOMBRE ARCHIVO*/
            $narchivo = 'RQ_'.round(microtime(true));
            
            //$pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/req/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/req/'.$narchivo.'.pdf';
            echo $ruta;
            
        }
        else {
            echo "No se puede generar el reporte solicitado, faltan datos por completar";
        }
    break;

}
