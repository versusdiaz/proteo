<?php
session_start();
require_once("../modelos/Reportes.php");
require_once("fpdf/fpdf.php");
require_once("fpdf/config.php");

$report = new Reportes();

/*INICIALIZO VARIABLES*/

$idrequest=isset($_POST['idrequest'])? limpiarCadena($_POST['idrequest']):"";


switch ($_GET["op"]){

    case 'reportRequisicion':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        if ($idrequest != ""){
            $codigo = 'ATM-RG-AD-004';
            $pdf = new PDF($codigo);
            $pdf->AddPage();

            $pdf->SetXY(10,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(96,5,'SERVICIO', 1, 0, 'C');

            $pdf->SetXY(76,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(5,5,'X', 1, 0, 'C');

            $pdf->SetXY(106,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(96,5,'MATERIALES', 1, 0, 'C');

            $pdf->SetXY(174,42);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(5,5,'X', 1, 0, 'C');
            // FILA 

            $pdf->SetXY(10,47);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(192,4,'DATOS BASICOS', 1, 0, 'C');

            $pdf->SetXY(10,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'N. REQUISICION', 1, 0, 'C');

            $pdf->SetXY(58,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'DEPARTAMENTO O AREA', 1, 0, 'C');

            $pdf->SetXY(106,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'PRIORIDAD', 1, 0, 'C');

            $pdf->SetXY(154,51);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'CERTIFICADO DE CALIDAD', 1, 0, 'C');

            // FILA

            $pdf->SetXY(10,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'', 1, 0, 'C');

            $pdf->SetXY(58,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'', 1, 0, 'C');

            $pdf->SetXY(106,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'', 1, 0, 'C');
//
            $pdf->SetXY(117,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,'X', 1, 0, 'C');

            $pdf->SetXY(106,55);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'CRITICO', 0, 0, 'L');

            $pdf->SetXY(132,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,'X', 1, 0, 'C');

            $pdf->SetXY(124,55);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'URGENTE', 0, 0, 'C');

            $pdf->SetXY(147,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(3,4,'X', 1, 0, 'C');

            $pdf->SetXY(138,55);
            $pdf->SetFont('Arial','B',6);
            $pdf->Cell(5,4,'NORMAL', 0, 0, 'C');

            $pdf->SetXY(154,55);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(48,4,'', 1, 0, 'C');


            // $X=5;
            // $Y=5;
            // $pdf->SetFont('Courier','B',12);
            // $pdf->SetXY($X+5,$Y+20);
            // $pdf->MultiCell(200,5,'CONSTANCIA DE ENTREGA DE TALONARIO',0,'C');
            // $talonario = new Imprimir();
            // $rsptaitem = $talonario->mostrarTalonario($idtalonario);
            // $pdf->SetXY($X+5,$Y+35);
            // $pdf->SetFont('Courier','',11);
            // $pdf->MultiCell(185,5,"Mediante la presente, se hace constar que el dia ".date('d-m-Y',strtotime($rsptaitem['fecha']))." se entrega de manera formal el Talonario correspondiente a la serie: ".$rsptaitem['desde']."-".$rsptaitem["hasta"].", Al Chofer o Proveedor ".$rsptaitem['nombre']." portador de la C.I: ".$rsptaitem['cedula'].", quien acepta bajo este documento, las politicas internas para el uso del o los talonarios las cuales se expresan a continuacion:",0,'L');
            // $pdf->SetFont('Courier','B',10);
            // $pdf->SetXY($X+5,$Y+65);
            // $pdf->Cell(10,4,'Politicas de uso del talonario:');
            // $pdf->SetXY($X+20,$Y+130);
            // $pdf->Cell(10,4,'__________________________');
            // $pdf->SetXY($X+20,$Y+135);
            // $pdf->Cell(10,4,'     Recibe Conforme      ');
            // $pdf->SetXY($X+120,$Y+130);
            // $pdf->Cell(10,4,'__________________________');
            // $pdf->SetXY($X+120,$Y+135);
            // $pdf->Cell(10,4,'          Entrega         ');

            /*NOMBRE ARCHIVO*/
            $narchivo = 'RT_'.round(microtime(true));
            
            $pdf->AliasNbPages();
            $pdf->Output('F','../vistas/reportes/req/'.$narchivo.'.pdf',true);
            $ruta = 'vistas/reportes/req/'.$narchivo.'.pdf';
            echo $ruta;
            
        }
        else {
            echo "No se puede generar el reporte solicitado, faltan datos por completar";
        }
    break;

}
