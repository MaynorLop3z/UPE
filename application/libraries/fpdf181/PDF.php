<?php
require('fpdf.php');
class PDF extends FPDF {
    private $totalFac, $clientFac, $dateFac, $dirFac;
// Cabecera de página
    function Header() {
        //$this->SetY(35);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        // Movernos a la derecha
//        $this->Cell(8);
        // Título
        $this->Cell(6, 3, $this->clientFac, 0, 0, 'C');
        $this->Cell(6, 3, $this->dateFac, 0, 0, 'C');
        // Salto de línea
       $this->Ln(2);
    }
// Pie de página
    function Footer() {
        // Posición: a 5 cm del final
        $this->SetY(-5);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(7, 5, $this->dirFac, 0, 0, 'C');
        $this->Cell(7, 5, '$ '.$this->totalFac, 0, 0, 'C'); 
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