<?php
require("pdf/fpdf.php");
require('clases/db_abstract_model.php');
require('clases/Usuario.php');
require('clases/Temarios.php');
class PDF extends FPDF
{
// Cabecera de pagina
function Header()
{
	// Logo
	$this->Image('images/logo.png',10,8,33);
	$this->Ln(30);
    $this->SetFont('Arial','B',20);
    $this->SetDrawColor(220,50,50);
    $this->SetFillColor(220,50,50);
    $this->SetTextColor(220,50,50);
    $this->Cell(0,10,'DATOS DE USUARIOS',"B",0,'C');
    // Salto de línea
    
    $this->Ln(20);
}

// Pie de p�gina
function Footer()
{
	// Posicion: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Numero de pagina
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
}
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(255,255,255);




$pdf->cell(50,10,"ID","B",0,"L",1);
$pdf->cell(10,10,"",0,0,"L");
$pdf->cell(50,10,"NOMBRE","B",0,"L",1);
$pdf->cell(10,10,"",0,0,"L");
$pdf->cell(50,10,"EMAIL","B",0,"L",1);
$pdf->Ln(20);
$pdf->SetTextColor(21,14,14);
$usr=new Usuario();
$usr->getAll();
$total=count($usr->get_rows());
$datos=$usr->get_rows();
foreach($datos as $indice=>$fila){
    $pdf->cell(50,10,$fila["id"],0,0,"L");
        $pdf->cell(10,10,"",0,0,"L");
		$pdf->cell(50,10,$fila["nombre"],0,0,"L");
		$pdf->cell(10,10,"",0,0,"L");//para crear espacio
        $pdf->cell(50,10,$fila["email"],0,0,"L");
        $pdf->Ln(20);
        
}

$pdf->SetFillColor(241, 199, 196);
$pdf->cell(100,10,"Total de usuarios registrados en PortalDocente:  ",0,0,"L",1);
$pdf->cell(50,10,$total,0,0,"L",1);
$pdf->Ln(10);
$temarios = new Temarios();

$pdf->cell(100,10,"Temarios subidos por usuarios:  ",0,0,"L",1);
$pdf->cell(50,10,$temarios-> getTotalTemarios(),0,0,"L",1);

$pdf->Output();
?>
