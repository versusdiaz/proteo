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
                $this->Image('../vistas/img/logoatm.png',15,18,25,20);
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
                $this->Cell(20,5, "00", 1, 0, 'C');
                    
                $this->SetXY(166,33);
                $this->SetFont('Arial','',8);
                $this->Cell(16,5,'PAGINA', 1, 0, 'C');
                $this->SetXY(182,33);
                $this->SetFont('Arial','',8);
    
                $this->Cell(20,5,''.$this->PageNo(), 1, 0, 'C');
                    
                $this->SetXY(10,38);
                $this->SetFont('Arial','B',8);
                $this->Cell(192,4,'REQUISICION', 1, 0, 'C');
                }
            }
            /*FOOTER UNIVERSAL*/
            function Footer()
            {
                $this->SetXY(-30,270);
                $this->SetFont('Arial','I',8);
                $this->Cell(25,4,'Pag '.$this->PageNo().'/{nb}',0,0,'C');
            }

            // // Una tabla más completa
            // function tablaTSMPP($header, $data, $dctos)
            // {
            //     // Anchuras de las columnas
            //     $w = array(30, 40, 30, 35, 40);
            //     //Variable que indica si se aplico sustraendo o no
            //     $nombreISLR = '';
            //     $subtotal = 0;
            //     $totalret = 0;
            //     $verificar = false;
            //     // Cabeceras
            //     $this->SetFont('Courier','B',8);
            //     for($i=0;$i<count($header);$i++)
            //         $this->Cell($w[$i],7,$header[$i],1,0,'C');
            //     $this->Ln();
            //     $this->SetFont('Courier','',8);
            //     foreach($data as $row)
            //     {
            //         $this->Cell($w[0],5,$row['fecha'],'LRB',0,'C');
            //         $this->Cell($w[1],5,$row['nombre'],'LRB',0,'C');
            //         $this->Cell($w[2],5,$row['codigo'],'LRB',0,'C');
            //         $this->Cell($w[3],5,$row['nombrec'],'LRB',0,'C');
            //         $this->Cell($w[4],5,number_format($row['montop'],2,',','.'),'LRB',0,'R');
            //         $subtotal = $subtotal + $row['montop'];
            //         $totalret = $totalret + $row['montoret'];
            //         $this->Ln();
            //     }
            //     // Línea de cierre
            //     $this->Cell(array_sum($w),0,'','T');
            //     $this->Ln();
            //     // Llamo descuentos
            //     foreach($dctos as $row)
            //     {
            //         if($row['iddescuento'] != 1){
            //             $this->Cell(100,5,'',0,0,'C');
            //             $this->Cell($w[3],5,$row['nombre'],1,0,'L');
            //             $this->Cell($w[4],5,number_format($row['montodesc']*-1,2,',','.'),'LRB',0,'R');
            //             $this->Ln();
            //             $nombreISLR = 'RET. ISLR:';
            //             $subtotal = $subtotal - $row['montodesc'];
            //             $totalret = $totalret - (0.01*$row['montodesc']);
            //             $verificar = true;
            //         } else {
            //             $totalret = $totalret - $row['montodesc'];
            //             $nombreISLR = 'RET. ISLR (-ST):';
            //             $verificar = true;
            //         }
            //     }

            //     //CELDA EN BLANCO PARA EMPUJAR
            //         $this->SetFont('Courier','B',8);
            //         $this->Cell(100,5,'',0,0,'C');
            //         $this->Cell($w[3],5,'SUBTOTAL BS:',1,0,'L');
            //         $this->Cell($w[4],5,number_format($subtotal,2,',','.'),1,0,'R');
            //         $this->Ln();
            //         $this->Cell(100,5,'',0,0,'C');
            //         if($verificar != false){
            //             $this->Cell($w[3],5,$nombreISLR,1,0,'L'); 
            //         }else{
            //             $this->Cell($w[3],5,'RET. ISLR:',1,0,'L');
            //         }
            //         $this->Cell($w[4],5,number_format($totalret,2,',','.'),1,0,'R');
            //         $this->Ln();
            //         $this->Cell(100,5,'',0,0,'C');
            //         $this->Cell($w[3],5,'TOTAL:',1,0,'L');
            //         $this->Cell($w[4],5,number_format($subtotal - $totalret,2,',','.'),1,0,'R');
            // }


        }



?>