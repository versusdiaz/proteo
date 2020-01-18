<?php
            /*CONST DE LA TABLA*/
            class PDF extends FPDF{
            
            private $codigo = '';
            private $elaborador = '';
            private $supervisor = '';
            private $fecha = '';

            private $fechaf = '';
            private $titulo = '';
            private $revision = '';

            function __construct($numRev,$elaborador,$supervisor,$fecha,$fechaf,$titulo,$revision){
                parent::__construct();
                $this->codigo = $numRev;
                $this->elaborador = $elaborador;
                $this->supervisor = $supervisor;
                $this->fecha = $fecha;
                $this->fechaf = $fechaf;
                $this->titulo = $titulo;
                $this->revision = $revision;

            }

            /*HEADER UNIVERSAL*/    
            function Header()
            {
                $X=5;
                $Y=5;
                // FIJAMOS EL COLOR PARA TODOS LOS RELLENOS
                $this->SetFillColor(198, 198, 247);
                $this->Image('../vistas/img/logoatm.png',15,18,25,19);
                if( $this->codigo != '' ){
                $this->SetXY(10,18);
                $this->SetFont('Arial','',14);
                $this->Cell(35,20, utf8_decode("   "), 1, 0, 'C');
                    
    
                $this->SetXY(45,18);
                $this->SetFont('Arial','',14);
                $this->Cell(121,20, utf8_decode("SISTEMA DE GESTIÓN DE LA CALIDAD"), 1, 0, 'L');
    
                $this->SetXY(166,18);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'CODIGO:', 1, 0, 'C');
                $this->SetXY(182,18);
                $this->SetFont('Arial','',7);
                $this->Cell(20,5, $this->codigo , 1, 0, 'C');
                    
                $this->SetXY(166,23);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'FECHA:', 1, 0, 'C');
                $this->SetXY(182,23);
                $this->SetFont('Arial','',8);
                $this->Cell(20,5, date('d/m/Y',strtotime($this->fechaf)), 1, 0, 'C');
                    
                $this->SetXY(166,28);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,utf8_decode('REVISION'), 1, 0, 'C');
                $this->SetXY(182,28);
                $this->SetFont('Arial','',8);
                $this->Cell(20,5, $this->revision , 1, 0, 'C');
                    
                $this->SetXY(166,33);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'PAGINA', 1, 0, 'C');
                $this->SetXY(182,33);
                $this->SetFont('Arial','',8);
    
                $this->Cell(20,5,''.$this->PageNo(), 1, 0, 'C');
                    
                $this->SetXY(10,38);
                $this->SetFont('Arial','B',8);
                $this->Cell(192,4, utf8_decode($this->titulo) , 1, 0, 'C', true);
                }
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
                $x = $this->getX();
                $y = $this->getY();
   
                $this->SetXY($x,$y);
                $this->SetFont('Arial','B',8);
                $this->Cell(30,5,'', 'LRT', 0, 'L');
                $this->Cell(81,5,'ELABORADO POR', 1, 0, 'C', true);
                $this->Cell(81,5,'APROBADO POR', 1, 0, 'C', true);

                $this->SetXY($x,$y+5);

                $this->SetFont('Arial','',6);
                $this->Cell(30,5,'NOMBRE Y APELLIDO:', 'LRT', 0, 'L');
                $this->Cell(81,5,''.$this->elaborador, 1, 0, 'L');
                $this->Cell(81,5,'KATIUSKA YAGUARACUTO', 1, 0, 'L');

                $this->SetXY($x,$y+10);
                $this->Cell(30,5,'CARGO:', 'LRT', 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');

                $this->SetXY($x,$y+15);
                $this->Cell(30,5,'FIRMA:', 'LRT', 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');
                $this->Cell(81,5,'', 1, 0, 'L');

                $this->SetXY($x,$y+20);
                $this->Cell(30,5,'FECHA:', 1, 0, 'L');
                $this->Cell(81,5,''.date('d/m/Y',strtotime($this->fecha)), 1, 0, 'L');
                $this->Cell(81,5,''.date('d/m/Y',strtotime($this->fecha)), 1, 0, 'L');

            }

            function tablaReq($header, $data){
                // Column widths
                $w = array(10, 134, 22, 26);
                // Header
                $this->SetFont('Arial','B',7);
                for($i=0;$i<count($header);$i++){
                    $this->Cell($w[$i],10,$header[$i],1,0,'C', true);
                }
                $nitem = 1;
                $this->Ln();
                $this->SetFont('Arial','',8);
                 // Data
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$nitem,'LRB',0,'C');
                    $this->Cell($w[1],6, ($row['detalle'] != '' )? utf8_encode($row['nombre'].' '.$row['detalle']): utf8_encode($row['nombre']) ,'LRB',0,'L');
                    $this->Cell($w[2],6,preg_replace('/^(\d+)\.0+$/', '$1',$row['cantidad']),'LRB',0,'C');
                    $this->Cell($w[3],6,$row['unidad'],'LRB',0,'C');
                    $this->Ln();
                    $nitem++;
                }

                for($nitem;$nitem <= 20; $nitem++){
                    $this->Cell($w[0],6,$nitem,'LRB',0,'C');
                    $this->Cell($w[1],6,'','LRB',0,'L');
                    $this->Cell($w[2],6,'','LRB',0,'C');
                    $this->Cell($w[3],6,'','LRB',0,'C');
                    $this->Ln();
                }
                // Closing line
                $this->Cell(array_sum($w),0,'','T');
            }

            function tablaOC($data){
                // Column widths
                $w = array(10, 20, 20, 95, 24, 23);
                // Header
                $nitem = 1;
                $subtotal = 0;
                $this->SetFont('Arial','',6);
                 // Data
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$nitem,'LRB',0,'C');
                    $this->Cell($w[1],6,preg_replace('/^(\d+)\.0+$/', '$1',$row['cantidad']),'LRB',0,'C');
                    $this->Cell($w[2],6,$row['unidad'],'LRB',0,'C');
                    $this->Cell($w[3],6, ($row['detalle'] != '' )? utf8_encode($row['nombre'].' '.$row['detalle']): utf8_encode($row['nombre']) ,'LRB',0,'L');
                    $this->Cell($w[4],6,number_format($row['precio'],2,',','.'),'LRB',0,'C');
                    $this->Cell($w[5],6,number_format($row['precio']*$row['cantidad'],2,',','.'),'LRB',0,'C');
                    $this->Ln();
                    $nitem++;
                    $subtotal = $subtotal + ( $row['precio']*$row['cantidad'] );
                }

                for($nitem;$nitem <= 13; $nitem++){
                    $this->Cell($w[0],6,$nitem,'LRB',0,'C');
                    $this->Cell($w[1],6,'','LRB',0,'L');
                    $this->Cell($w[2],6,'','LRB',0,'C');
                    $this->Cell($w[3],6,'','LRB',0,'C');
                    $this->Cell($w[4],6,'','LRB',0,'C');
                    $this->Cell($w[5],6,'','LRB',0,'C');
                    $this->Ln();
                }
                // Closing line
                $this->Cell(array_sum($w),0,'','T');
                return $subtotal;
            }

        }



?>