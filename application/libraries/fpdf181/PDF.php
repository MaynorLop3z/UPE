<?php
require('fpdf.php');
class PDF extends FPDF {
    private $totalFac, $clientFac, $dateFac, $dirFac;
// Cabecera de página
    function Header() {
        //$this->SetY(35);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 9);
        // Movernos a la derecha
//        $this->Cell(8);
        // Título
        $this->Cell(16, 2, "SYSTEMA DE LA UNIDAD DE PROYECTOS ACADEMICOS ESPECIALES (PAESYS)", 0, 0, 'C');
       
         $this->Cell(5, 2,"fecha:".date("Y-m-d H:i") , 0, 0, 'C');
//        $this->Cell(6, 3, $this->dateFac, 0, 0, 'C');
        // Salto de línea
       $this->Ln(2);
       
//       $this->SetY(-5);
//        $this->SetFont('Arial', 'I', 10);
//        $this->Cell(7, 5, $this->dirFac, 0, 0, 'C');
//        $this->Cell(7, 5, '$ '.$this->totalFac, 0, 0, 'C');
    }
// Pie de página
    function Footer() {
        // Posición: a 5 cm del final
        $this->SetY(-5);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(7, 5, "UNIDAD DE PROYECTOS ESPECIALES", 0, 0, 'C');
        $this->Cell(7, 5, 'PAESYS', 0, 0, 'C'); 
    }
    function setTotal($total) {
        $this->totalFac = $total;
    }
    function setDateFac($fecha) {
        $this->dateFac = $fecha;
    }
    function setClientName($nombre) {
        $this->clientFac = $nombre;
    }
    function setDirection($dir) {
        $this->dirFac = $dir;
    }
}