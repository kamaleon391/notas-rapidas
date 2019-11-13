<?php
    function imprime_portada($pdf, $tema){
        $pdf->enableheader = 'header1';
        $pdf->AddPage('PORTRAIT', 'LETTER');
        $pdf->enablefooter = 'footer1';

        $pdf->SetFont('Arial','B',36);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetY(120);
        $pdf->MultiCell(0, 5, $tema,0, 'C');
        $pdf->Ln();
        $pdf->Ln();

        mostrar_fecha_completa($pdf);
    }

    function mostrar_fecha_completa($pdf){
        $fecha = $dia = $mes = '';
        $pdf->SetFont('Arial','B',28);
        $pdf->SetTextColor(199,199,199);

        switch(date('N')){
            case 1 : $dia = 'Lunes';
            break;
            case 2 : $dia = 'Martes';
            break;
            case 3 : $dia = 'Miércoles';
            break;
            case 4 : $dia = 'Jueves';
            break;
            case 5 : $dia = 'Viernes';
            break;
            case 6 : $dia = 'Sábado';
            break;
            case 7 : $dia = 'Domingo';
        }

        switch(date('m')){
            case 1: $mes = 'Enero';
            break;
            case 2: $mes = 'Febrero';
            break;
            case 3: $mes = 'Marzo';
            break;
            case 4: $mes = 'Abril';
            break;
            case 5: $mes = 'Mayo';
            break;
            case 6: $mes = 'Junio';
            break;
            case 7: $mes = 'Julio';
            break;
            case 8: $mes = 'Agosto';
            break;
            case 9: $mes = 'Septiembre';
            break;
            case 10: $mes = 'Octubre';
            break;
            case 11: $mes = 'Noviembre';
            break;
            case 12: $mes = 'Diciembre';
        }

        $fecha = $dia.' '. date('d').' de '. $mes . ' de '. date('Y');
        $pdf->MultiCell(0, 5, $fecha,0, 'C');
    }
?>