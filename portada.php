<?php
    function imprime_portada($pdf, $tema){
        $pdf->enableheader = 'header1';
        $pdf->AddPage('PORTRAIT', 'LETTER');
        $pdf->enablefooter = 'footer1';

        $pdf->SetY(10);
        $pdf->SetFont('Arial','B',32);
        $pdf->SetTextColor(0,0,0);
        $pdf->Text(60,150, $tema);
    }
?>