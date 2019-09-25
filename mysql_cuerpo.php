<?php
    function cuerpo($pdf, $conexion, $tema)
    {
        // Obtenemos los datos de MySQL
        $query = "SELECT * FROM notas";
        $result = mysqli_query($conexion,$query);

        $pdf->SetY(25);
        while($row = mysqli_fetch_array($result)) {
            if($tema == $row['tema']){
                if($pdf->GetY() <= 220){
                    contenido($pdf,$row);
                } else {
                    $pdf->AddPage('PORTRAIT', 'LETTER');
                    $pdf->SetY(25);
                    contenido($pdf,$row);
                }
            }
        }
    }
    
    function contenido($pdf,$row){
        // Mostramos el titulo de la nota
        $pdf->SetFont('Arial','B',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(0, 5, utf8_encode($row['encabezado']),0, 'L');

        // Mostramos las subsecciones
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(117,117,117);
        $pdf->MultiCell(0, 5, 'Estado: '. utf8_encode($row['estado']) .' | Sección: '. utf8_encode($row['seccion']) .' | Categoría: '. utf8_encode($row['categoria']) .' | Autor: '. utf8_encode($row['autor']),0, 'L');

        // Dibuja una linea
        $pdf->SetDrawColor(13,149,71);
        $pdf->SetLineWidth(0.25);
        $pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY());

        // Mostramos el subtitulo de la nota
        if($row['titulo'] != NULL){
            $pdf->SetFont('Arial','B',10);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(0, 5, utf8_encode($row['titulo']),0, 'L');
        }

        // Mostramos el texto de la nota
        if($row['texto'] != NULL){
            $pdf->SetFont('Arial','',9);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(0, 5, utf8_encode($row['texto']),0, 'L');
        }

        // Mostramos el link
        $pdf->SetFont('Arial','',9);
        $pdf->SetTextColor(0,27,255);
        $pdf->Cell(0, 5, 'Medio - página: N ',0, 1,'L',false,$row['link']);
        $pdf->Ln();
    }
?>