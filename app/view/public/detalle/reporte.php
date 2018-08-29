<?php
    require_once("../../../models/database.class.php");
    require('../../../helpers/fpdf.php');

    session_name("pagina_publica");
	session_start();

    class PDF extends FPDF
    {
        // Cabecera de p�gina
        function Header()
        {
            // Logo
            $this->Image('../../../../web/img/mipintura_negro1.png',10,8,40);
            // Arial bold 15
            $this->SetFont('Arial','B',18);
            // Movernos a la derecha
            $this->Cell(80);
            // T�tulo
            $this->Cell(40,10,'Factura',0,0,'C');
            // Salto de l�nea
            $this->Ln(20);
        }

        // Pie de p�gina
        function Footer()
        {
            // Posici�n: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // N�mero de p�gina
            
            $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'R');
        }
        // Una tabla m�s completa
        function ImprovedTable($header, $result)
        {
            foreach($result as $row){
                $fecha = $row['fecha'];
            }
            $this->Cell(0,6,'A nombre de: '.$_SESSION['nombres_p'].' '.$_SESSION['apellidos_p'],0,0);
            $this->Ln();
            $this->Cell(0,6,'Fecha de la compra: '.$fecha,0,0);
            $this->Ln();
            $this->Cell(0,6,'Id del pedido: '.$_SESSION['id_ult_pedi'],0,0);
            $this->Ln();

            $total = null;
            // Anchuras de las columnas
            $w = array(85, 35, 35,35);
            // Cabeceras
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7, $header[$i] ,1,0,'C');
            $this->Ln();
            // Datos
            foreach($result as $row)
            {
                $this->Cell($w[0],6,$row['nombre'],'LR');
                $this->Cell($w[1],6,$row['CANT'],'LR');
                $this->Cell($w[2],6,$row['precio'],'LR');
                $this->Cell($w[3],6,$row['subtotal'],'LR');
                $total = $total + $row['subtotal'];
                $this->Ln();
            }
            // L�nea de cierre
            $this->Cell(array_sum($w),0,'','T');

            $this->Ln();
            $this->Cell($w[0],0,null,'LR');
            $this->Cell($w[1],0,null,'LR');
            $this->Cell($w[2],7,'Total:','LB',0,'R');

            $total = number_format($total, 2);

            $this->Cell($w[3],7,'$'.$total,'RB',0,'L');
        }
    }
    // Creaci�n del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->setTitle('Ticket');
    // T�tulos de las columnas
    $header = array('Producto', 'Cantidad', 'Precio', 'Subtotal');
    // Carga de datos
    $sql = "SELECT detalle_pedido.cantidad AS CANT, nombre, fecha, total, precio, precio * detalle_pedido.cantidad AS subtotal FROM detalle_pedido INNER JOIN producto USING(id_producto) INNER JOIN pedido USING(id_pedido) WHERE id_pedido = ?";
    $params = array($_SESSION['id_ult_pedi']);
    $result = Database::getRows($sql, $params);

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    $pdf->ImprovedTable($header,$result);
    $pdf->Output('d');
?>