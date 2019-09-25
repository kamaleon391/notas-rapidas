<?php
    include 'plantilla.php';
    require 'mysql_cuerpo.php';
    require 'portada.php';
    require 'db.php';

    // Creamos el PDF
    $pdf = new pdf('P', 'mm', array(216,279), true);
    $tema ="";
    $tipo = "";

    // Obtenemos los datos de MySQL
    $consulta = "SELECT DISTINCT tema, tipo FROM notas;";
    $resultado = mysqli_query($conexion,$consulta);
    while($fila = mysqli_fetch_array($resultado)){
        // Imprimimos la portada
        $GLOBALS['tema'] = $fila['tema'];
        $GLOBALS['tipo'] = $fila['tipo'];
        imprime_portada($pdf, $tema);
        
        // Muestra el PDF con su contenido
        $pdf->enableheader = 'header2';
        $pdf->AddPage('PORTRAIT', 'LETTER');
        $pdf->enablefooter = 'footer2';
        $pdf->SetMargins(14,30,20,20);
        //body($pdf);
        cuerpo($pdf, $conexion, $tema);
    }
    mysqli_close($conexion);

	$pdf->Output();
?>