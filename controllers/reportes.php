<?php
session_start();
require_once("../modelos/Reportes.php");
require_once("fpdf/fpdf.php");

$report = new Reportes();

/*INICIALIZO VARIABLES*/

$idrequest=isset($_POST['idrequest'])? limpiarCadena($_POST['idrequest']):"";

$idrequest_temp=isset($_POST['idrequest_temp'])? limpiarCadena($_POST['idrequest_temp']):"";

$bdDepartamento=isset($_POST['bdDepartamento'])? limpiarCadena($_POST['bdDepartamento']):"";

$bdReq=isset($_POST['bdReq'])? limpiarCadena($_POST['bdReq']):"";

$idodc=isset($_POST['idodc'])? limpiarCadena($_POST['idodc']):"";

$idpcs=isset($_POST['idpcs'])? limpiarCadena($_POST['idpcs']):"";

switch ($_GET["op"]){

    case 'reportRequisicion':
    require_once("fpdf/config.php");
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
            $pdf->Cell(48,4,utf8_decode('Nº ORDEN DE SERVICIO'), 1, 0, 'C', true);

            $pdf->SetXY(106,51);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(48,4,'DEPARTAMENTO O AREA SOLICITANTE', 1, 0, 'C', true);

            $pdf->SetXY(154,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'FECHA', 1, 0, 'C', true);

            // FILA

            $pdf->SetXY(10,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,$numReq['codigo'], 1, 0, 'C');

            $pdf->SetXY(58,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'NO APLICA', 1, 0, 'C');

            $pdf->SetXY(106,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,$dataReq['dpto'], 1, 0, 'C');

            $pdf->SetXY(154,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,date('d/m/Y',strtotime($dataReq['fecha'])), 1, 0, 'C');



            // FILA

            $pdf->SetXY(10,59);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(100,4,utf8_decode('STOCK'), 1, 0, 'C', true);

            $pdf->SetXY(10,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(96,4,'', 1, 0, 'C');

            //

            $pdf->SetXY(30,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 3 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(14,63);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(5,4,'SALIDA', 0, 0, 'L');

            $pdf->SetXY(60,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 2 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(44,63);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(5,4,'REPOSICION', 0, 0, 'C');

            $pdf->SetXY(90,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 1 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(74,63);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(5,4,'NO APLICA', 0, 0, 'C');

            //


            $pdf->SetXY(106,59);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'PRIORIDAD', 1, 0, 'C', true);

            // 
            $pdf->SetXY(106,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'', 1, 0, 'C');
            
            $pdf->SetXY(117,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 3 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(106,63);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'CRITICO', 0, 0, 'L');

            $pdf->SetXY(132,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 2 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(124,63);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'URGENTE', 0, 0, 'C');

            $pdf->SetXY(147,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,($dataReq['prioridad'] != 1 ) ? '': 'X' , 1, 0, 'C');

            $pdf->SetXY(138,63);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'NORMAL', 0, 0, 'C');

            // $pdf->SetXY(58,59);
            // $pdf->SetFont('Arial','B',8);
            // $pdf->Cell(72,4,'NOMBRE DE LA EMBARCACION', 1, 0, 'C', true);

            // $pdf->SetXY(58,63);
            // $pdf->SetFont('Arial','B',8);
            // $pdf->Cell(72,4,$dataReq['nombre'], 1, 0, 'C');

            $pdf->SetXY(154,59);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'CERTIFICADO DE CALIDAD', 1, 0, 'C', true);

            $pdf->SetXY(178,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(24,4,'NO', 1, 0, 'C');

            $pdf->SetXY(154,63);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(24,4,'SI', 1, 0, 'C');

            $pdf->SetXY(170,63);
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
            $pdf->MultiCell(192,20,$dataReq['comentario'].' - CC: '.$dataReq['nombre'], 'LRB', 'L', 0);
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
    require_once("fpdf/config-nf.php");
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        if ($idodc != ""){
            $formato = $report->dataFormato(2);
            $codigo = $formato['codigo'];
            $fechaf = $formato['fecha'];
            $titulo = $formato['titulo'];
            $revision = $formato['revision'];

            $subtotal = 0;

            $numReq = $report->numReq($idrequest_temp, $bdDepartamento);

            $dataReq = $report->mostrarRequest($idrequest_temp);

            $dataOC = $report->mostrarOC($idodc,$bdDepartamento,$bdReq);

            $pdf = new PDF($codigo,$dataReq['responsable'],$dataReq['supervisor'],$dataReq['fecha'],$fechaf,$titulo,$revision);

            $pdf->AddPage();
            // FIJAMOS EL COLOR PARA TODOS LOS RELLENOS
               $pdf->SetFillColor(198, 198, 247);

               $pdf->SetXY(10,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(44,5,utf8_decode('Nº ORDEN DE COMPRA'), 1, 0, 'C', true);

               $pdf->SetXY(54,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(44,5,utf8_decode('Nº REQUISICION'), 1, 0, 'C', true);

               $pdf->SetXY(98,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(82,5,'NOMBRE DEL PROVEEDOR', 1, 0, 'C', true);

               $pdf->SetXY(180,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(22,5,'FECHA', 1, 0, 'C', true);

//             FILA 

                $pdf->SetXY(10,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(44,5,utf8_decode($numReq['codigo']), 1, 0, 'C');

                $pdf->SetXY(54,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(44,5,utf8_decode($dataOC['codigo']), 1, 0, 'C');

                $pdf->SetXY(98,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(82,5,utf8_decode($dataOC['nombre']), 1, 0, 'C');

                $pdf->SetXY(180,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(22,5,date('d/m/Y',strtotime($dataReq['fecha'])), 1, 0, 'C');

//             FILA

               $pdf->SetXY(10,52);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(88,5,'CONDICIONES DE ENTREGA', 1, 0, 'C', true);

               $pdf->SetXY(98,52);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(68,5,'LUGAR Y FECHA DE ENTREGA', 1, 0, 'C', true);

               $pdf->SetXY(166,52);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(36,5,'CONDICIONES DE PAGO', 1, 0, 'C', true);

//             FILA

               $pdf->SetXY(10,57);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(88,15,'INMEDIATA', 1, 0, 'C');

               $pdf->SetXY(98,57);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(68,15,'PUERTO LA CRUZ -'.date('d/m/Y',strtotime($dataReq['fecha'])), 1, 0, 'C');

               $pdf->SetXY(166,57);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(36,15,'CREDITO - 7 DIAS', 1, 0, 'C');

//             FILA

               $pdf->SetXY(10,72);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(145,10,'LE SOLICITAMOS LOS SIGUIENTES PRODUCTOS, CUYOS PRECIOS CORRESPONDEN AL', 1, 0, 'C', true);


               $pdf->SetXY(155,72);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(24,4,utf8_decode('Nº COTIZACION'), 1, 0, 'C', true);

               $pdf->SetXY(155,76);
               $pdf->SetFont('Arial','B',5);
               $pdf->Cell(24,6,($dataOC['cotizacion'] == null )? 'POR CONFIRMAR': utf8_decode($dataOC['cotizacion']), 1, 0, 'C');

               $pdf->SetXY(179,72);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(23,4,utf8_decode('FECHA'), 1, 0, 'C', true);

               $pdf->SetXY(179,76);
               $pdf->SetFont('Arial','B',5);
               $pdf->Cell(23,6,date('d/m/Y',strtotime($dataReq['fecha'])), 1, 0, 'C');
// FILA
               $pdf->SetXY(10,82);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(10, 14, 'ITEM', 1, 'C', true);

               $pdf->SetXY(20,82);
               $pdf->MultiCell(20, 14, 'CANTIDAD', 1, 'C', true);

               $pdf->SetXY(40,82);
               $pdf->SetFont('Arial','B',5);
               $pdf->MultiCell(20, 14, 'UNIDAD DE MEDIDA', 1, 'C', true);

               $pdf->SetXY(60,82);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(95, 4, 'DESCRIPCION DEL PRODUCTO', 'LTR', 'C', true);

               $pdf->SetXY(60,86);
               $pdf->SetFont('Arial','',5);
               $pdf->MultiCell(95, 2, '(TIPO, REFERENCIA, MODELO,CLASE,GRADO,CARACTERISTICAS', 'LR', 'C', true);

               $pdf->SetXY(60,88);
               $pdf->MultiCell(95, 2, '(TECNICAS,PLANOS,ESQUEMAS,ESPECIFICACIONES,REQUISITOS DEL PROCESO Y', 'LR', 'C', true);

               $pdf->SetXY(60,90);
               $pdf->MultiCell(95, 2, 'CUALQUIER OTRA DESCRIPCION)', 'LR', 'C', true);

               $pdf->SetXY(60,92);
               $pdf->MultiCell(95, 4, '', 'LRB', 'C', true);

               $pdf->SetXY(155,82);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(24, 14, 'VALOR UNITARIO', 1, 'C', true);

               $pdf->SetXY(179,82);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(23, 14, 'VALOR TOTAL', 1, 'C', true);

               $rsptaitem = $report->mostrarItems($idrequest_temp);
               // GENERO LA TABLA Y RETORNO EL SUBTOTAL
               $subtotal = $pdf->tablaOC($rsptaitem);

               $pdf->ln();

               $x = $pdf->getX();
               $y = $pdf->getY();
   
               $pdf->SetXY($x,$y+2);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(169,5,'Sub-Total', 'LTR', 0, 'R');

               $pdf->SetXY($x+169,$y+2);
               $pdf->Cell(23,5,number_format($subtotal,2,',','.'), 1, 0, 'R');

               $pdf->SetXY($x,$y+7);
               $pdf->Cell(169,5,'IVA 16 %', 'LR', 0, 'R');
               $pdf->SetXY($x+169,$y+7);
               $pdf->Cell(23,5,number_format($subtotal * 0.16 ,2,',','.'), 1, 0, 'R');

               $pdf->SetXY($x,$y+12);
               $pdf->Cell(169,5,'Total', 'LR', 0, 'R');
               $pdf->SetXY($x+169,$y+12);
               $pdf->Cell(23,5,number_format($subtotal * 1.16 ,2,',','.'), 1, 0, 'R');

               $pdf->SetXY($x,$y+17);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(192,5,'REQUISITOS DE CALIDAD', 1, 0, 'C', true);

               $pdf->SetXY($x,$y+22);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(30,5,'URGENTE', 1, 0, 'C', true);

               $pdf->SetXY($x+30,$y+22);
               $pdf->Cell(76,5,'NORMATIVA DOCUMENTOS APLICABLES', 1, 0, 'C', true);

               $pdf->SetXY($x+106,$y+22);
               $pdf->Cell(86,5,'ESPECIFICACIONES DE EMBALAJE Y ENVIO', 1, 0, 'C', true);

               // LINEA

               $pdf->SetXY($x,$y+27);
               $pdf->Cell(30,5,'SI__ NO_X_', 1, 0, 'C');

               $pdf->SetXY($x,$y+32);
               $pdf->Cell(30,5,'CERIF. CALIDAD', 1, 0, 'C', true);

               $pdf->SetXY($x,$y+37);
               $pdf->Cell(30,5,'SI__ NO_X_', 1, 0, 'C');

               $pdf->SetXY($x+30,$y+27);
               $pdf->Cell(76,15,'NO APLICA', 1, 0, 'C');

               $pdf->SetXY($x+106,$y+27);
               $pdf->Cell(86,10,'NO APLICA', 1, 0, 'C');

               $pdf->SetXY($x+106,$y+37);
               $pdf->Cell(86,5,'CONDICIONES DE SEGURIDAD', 1, 0, 'C', true);

                // LINEA

               $pdf->SetXY($x,$y+42);
               $pdf->Cell(106,5,'CARGO AUTORIZADO PARA LA INSPECCION EN RECEPCION', 1, 0, 'C', true);

               $pdf->SetXY($x,$y+47);
               $pdf->Cell(106,5,'NO APLICA', 1, 0, 'C');

               $pdf->SetXY($x+106,$y+42);
               $pdf->Cell(86,10,'NO APLICA', 1, 0, 'C');

               $pdf->SetXY($x,$y+52);
               $pdf->SetFont('Arial','B',8);
               $pdf->Cell(192,5,'OBSERVACIONES', 1, 0, 'C', true);

               $pdf->SetXY($x,$y+57);
               $pdf->Cell(192,5,'', 1, 0, 'C');
               $pdf->SetXY($x,$y+62);
               $pdf->Cell(192,5,'', 1, 0, 'C');
               $pdf->SetXY($x,$y+67);
               $pdf->Cell(192,5,'', 1, 0, 'C');

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

    case 'reportPresupuesto':
    require_once("fpdf/config-n0f.php");
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        if ($idpcs != ""){
            $formato = $report->dataFormato(3);
            $codigo = $formato['codigo'];
            $fechaf = $formato['fecha'];
            $titulo = $formato['titulo'];
            $revision = $formato['revision'];

            $subtotal = 0;

            // $numReq = $report->numReq($idrequest_temp, $bdDepartamento); ACTIVAR SI SE NECESITA MOSTRAR NUMREQ

            $dataReq = $report->mostrarRequest($idrequest_temp);

            $dataPCS = $report->mostrarPCS($idpcs);

            $pdf = new PDF($codigo,$dataReq['responsable'],$dataReq['supervisor'],$dataReq['fecha'],$fechaf,$titulo,$revision);

            $pdf->AddPage();
            // FIJAMOS EL COLOR PARA TODOS LOS RELLENOS
               $pdf->SetFillColor(198, 198, 247);

               $pdf->SetXY(10,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(44,5,utf8_decode('Nº COTIZACION'), 1, 0, 'C', true);

               $pdf->SetXY(54,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(82,5,utf8_decode('NOMBRE DE PROVEEDOR'), 1, 0, 'C', true);

               $pdf->SetXY(136,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(44,5,'COD. PROVEEDOR', 1, 0, 'C', true);

               $pdf->SetXY(180,42);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(22,5,'FECHA', 1, 0, 'C', true);

//             FILA 

                $pdf->SetXY(10,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(44,5,utf8_decode($dataPCS['codigo']), 1, 0, 'C');

                $pdf->SetXY(54,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(82,5,utf8_decode($dataPCS['nombre']), 1, 0, 'C');

                $pdf->SetXY(136,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(44,5,utf8_decode($dataPCS['nfiscal']), 1, 0, 'C');

                $pdf->SetXY(180,47);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(22,5,date('d/m/Y',strtotime($dataReq['fecha'])), 1, 0, 'C');

//             FILA

               $pdf->SetXY(10,52);
               $pdf->SetFont('Arial','B',6);
               $pdf->Cell(192,10,'NOSOTROS LE COTIZAMOS LOS SIGUIENTES PRODUCTOS Y/O SERVICIOS', 1, 0, 'C', true);

// FILA
               $pdf->SetXY(10,62);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(10, 14, 'ITEM', 1, 'C', true);

               $pdf->SetXY(20,62);
               $pdf->MultiCell(20, 14, 'CANTIDAD', 1, 'C', true);

               $pdf->SetXY(40,62);
               $pdf->SetFont('Arial','B',5);
               $pdf->MultiCell(20, 14, 'UNIDAD DE MEDIDA', 1, 'C', true);

               $pdf->SetXY(60,62);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(95, 4, 'DESCRIPCION DEL PRODUCTO', 'LTR', 'C', true);

               $pdf->SetXY(60,66);
               $pdf->SetFont('Arial','',5);
               $pdf->MultiCell(95, 2, '(TIPO, REFERENCIA, MODELO,CLASE,GRADO,CARACTERISTICAS', 'LR', 'C', true);

               $pdf->SetXY(60,68);
               $pdf->MultiCell(95, 2, '(TECNICAS,PLANOS,ESQUEMAS,ESPECIFICACIONES,REQUISITOS DEL PROCESO Y', 'LR', 'C', true);

               $pdf->SetXY(60,70);
               $pdf->MultiCell(95, 2, 'CUALQUIER OTRA DESCRIPCION)', 'LR', 'C', true);

               $pdf->SetXY(60,72);
               $pdf->MultiCell(95, 4, '', 'LRB', 'C', true);

               $pdf->SetXY(155,62);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(24, 14, 'VALOR UNITARIO', 1, 'C', true);

               $pdf->SetXY(179,62);
               $pdf->SetFont('Arial','B',6);
               $pdf->MultiCell(23, 14, 'VALOR TOTAL', 1, 'C', true);

               $rsptaitem = $report->mostrarItems($idrequest_temp);
               // GENERO LA TABLA Y RETORNO EL SUBTOTAL
               $subtotal = $pdf->tablaOC($rsptaitem);

               $pdf->ln();

               $x = $pdf->getX();
               $y = $pdf->getY();
   
               $pdf->SetXY($x,$y+2);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(169,5,'Sub-Total', 'LTR', 0, 'R');

               $pdf->SetXY($x+169,$y+2);
               $pdf->Cell(23,5,number_format($subtotal,2,',','.'), 1, 0, 'R');

               $pdf->SetXY($x,$y+7);
               $pdf->Cell(169,5,'IVA  %', 'LR', 0, 'R');
               $pdf->SetXY($x+169,$y+7);
               $pdf->Cell(23,5,'', 1, 0, 'R');

               $pdf->SetXY($x,$y+12);
               $pdf->Cell(169,5,'Total', 'LR', 0, 'R');
               $pdf->SetXY($x+169,$y+12);
               $pdf->Cell(23,5,'', 1, 0, 'R');

                // FILA

                $pdf->SetXY($x,$y+17);
                $pdf->SetFont('Arial','B',6);
                $pdf->Cell(88,5,'DIRECCION / TELEFONO', 1, 0, 'C', true);

                $pdf->SetXY($x+88,$y+17);
                $pdf->SetFont('Arial','B',6);
                $pdf->Cell(68,5,'SELLO DEL PROVEEDOR', 1, 0, 'C', true);

                $pdf->SetXY($x+156,$y+17);
                $pdf->SetFont('Arial','B',6);
                $pdf->Cell(36,5,'CONDICIONES DE PAGO', 1, 0, 'C', true);


            // FILA

               $pdf->SetXY($x,$y+17);
               $pdf->SetFont('Arial','',6);
               $pdf->Cell(88,20,$dataPCS['direccion'].' / '.$dataPCS['telefono'], 1, 0, 'L');

               $pdf->SetXY($x+88,$y+17);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(68,20,'', 1, 0, 'C');

               $pdf->SetXY($x+156,$y+17);
               $pdf->SetFont('Arial','',8);
               $pdf->Cell(36,20,'CREDITO - 7 DIAS', 1, 0, 'C');

               //LINEA

                $pdf->SetXY($x,$y+37);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(192,5,'OBSERVACIONES', 1, 0, 'C', true);

                $pdf->SetXY($x,$y+42);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(192,5,'PRECIO SUJETO A CAMBIO SIN PREVIO AVISO', 1, 0, 'C');
                $pdf->SetXY($x,$y+47);
                $pdf->Cell(192,5,'SUBTOTAL NO INCLUYE IVA', 1, 0, 'C');
                $pdf->SetXY($x,$y+52);
                $pdf->Cell(192,5,'', 1, 0, 'C');

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

}
