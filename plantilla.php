<?php
	require '../fpdf/fpdf.php';

    class PDF extends FPDF {
        function Header(){
            if(!empty($this->enableheader))
                call_user_func($this->enableheader,$this);
		}

        function Footer(){
            if(!empty($this->enablefooter))
                call_user_func($this->enablefooter,$this);
        }
    }

    function header1($pdf){
		$pdf->SetFont('Arial','B',16);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(50,6,' ',0,0,'L');
	}
	
    function footer1($pdf){
		$pdf->SetY(280);
		$pdf->SetTextColor(255,255,255);
        $pdf->Cell(50,6,'Footer type 1',1,0,'L');
        $pdf->Cell(0,6,"Page: {$pdf->PageNo()} of {nb}",1,0,'R');
    }
	
    function header2($pdf){
		$temario = $GLOBALS['tema'];
		$tipado = $GLOBALS['tipo'];

		// Escribe el titulo del encabezado
		$pdf->SetFont('Arial','B',16);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetY(10);
		$pdf->Text(15,15, $temario);

		// Dibuja un rectangulo sobre la linea
		$pdf->SetDrawColor(13,149,71);
		$pdf->SetFillColor(13,149,71);
		$pdf->Rect(145,5,9,15,'F');

		// Dibuja una linea
		$pdf->SetLineWidth(0.5);
		$pdf->Line(15, $pdf->GetY() + 10, 153.75, $pdf->GetY() + 10);

		// Dibuja el otro rectangulo
		$pdf->SetDrawColor(13,67,79);
		$pdf->SetFillColor(13,67,79);
		$pdf->Rect(156,5,35,15,'F');

		// Mostramos el tipo (CDMX, Estados, etc...)
		if($tipado == "CDMX"){
			$pdf->SetFont('Arial','B',18);
			$pdf->SetTextColor(255,255,255);
			$pdf->Text(164	,15, $tipado);
		} else {
			$pdf->SetFont('Arial','B',16);
			$pdf->SetTextColor(255,255,255);
			$pdf->Text(160	,15, $tipado);
		}

		// Inserta una imagen
		$pdf->Image('img/kali.png', 193, 5, 14, 15, 'png');
		$pdf->SetY(25);
	}
	
	function footer2($pdf)
	{
		//Insertamos una linea
		$pdf->SetLineWidth(2);
		$pdf->Line(15, 260, 200, 260);

		$pdf->SetFont('Arial','B',10);
		$pdf->SetY(-15);
		$pdf->SetTextColor(0,0,0);
		$pdf->Write(5,'Reporte de Anexo tema');

		$pdf->SetX(-20);
		$pdf->AliasNbPages('tpagina');
		$pdf->Write(5, 'Página: '.$pdf->PageNo().'/tpagina');

		// Inserta una imagen
		$pdf->Image('img/kali.png', 100, 262, 12, 13, 'png');
    }
?>