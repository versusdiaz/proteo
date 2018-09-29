<?php
            /*CONST DE LA TABLA*/
            class PDF extends FPDF{
            
            private $codigo = '';
            function __construct($numRev){
                parent::__construct();
                $this->codigo = $numRev;
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
                $this->Cell(20,5, '14/09/2018', 1, 0, 'C');
                    
                $this->SetXY(166,28);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,utf8_decode('REVISION'), 1, 0, 'C');
                $this->SetXY(182,28);
                $this->SetFont('Arial','',8);
                $this->Cell(20,5, "02", 1, 0, 'C');
                    
                $this->SetXY(166,33);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'PAGINA', 1, 0, 'C');
                $this->SetXY(182,33);
                $this->SetFont('Arial','',8);
    
                $this->Cell(20,5,''.$this->PageNo(), 1, 0, 'C');
                    
                $this->SetXY(10,38);
                $this->SetFont('Arial','B',8);
                $this->Cell(192,4,'REQUISICION', 1, 0, 'C', true);
                }
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
                $x = $this->getX();
                $y = $this->getY();
                $this->SetXY($x,$y);
                $this->SetFont('Arial','B',8);
                $this->Cell(72,5,'ELABORADO POR', 1, 0, 'C', true);
                $this->Cell(31,5,'FECHA', 1, 0, 'C', true);
                $this->Cell(58,5,'APROBADO POR', 1, 0, 'C', true);
                $this->Cell(31,5,'FECHA', 1, 0, 'C', true);

                $this->SetXY($x,$y+5);

                $this->SetFont('Arial','',6);
                $this->Cell(72,5,'NOMBRE Y APELLIDO:', 1, 0, 'L');
                $this->Cell(31,5,'25/09/18', 1, 0, 'C');
                $this->Cell(58,5,'NOMBRE Y APELLIDO:', 1, 0, 'L');
                $this->Cell(31,5,'25/09/18', 1, 0, 'C');

                $this->SetXY($x,$y+10);
                $this->Cell(72,5,'CARGO:', 1, 0, 'L');
                $this->Cell(31,5,'', 1, 0, 'C');
                $this->Cell(58,5,'CARGO:', 1, 0, 'L');
                $this->Cell(31,5,'', 1, 0, 'C');

                $this->SetXY($x,$y+15);
                $this->Cell(72,5,'FIRMA:', 1, 0, 'L');
                $this->Cell(31,5,'', 1, 0, 'C');
                $this->Cell(58,5,'FIRMA:', 1, 0, 'L');
                $this->Cell(31,5,'', 1, 0, 'C');

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
                $this->SetFont('Arial','B',8);
                 // Data
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$nitem,'LRB',0,'C');
                    $this->Cell($w[1],6,utf8_encode($row['nombre']),'LRB',0,'L');
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

        }



?>