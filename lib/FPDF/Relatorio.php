<?php
include 'Core/fpdf.php';
include __DIR__.'/../../app/Models/UsuarioModel.php';
include __DIR__.'/../../app/Models/PerfilModel.php';

$usuarios = new UsuarioModel();
$perfis = new PerfilModel();

$pdf = new FPDF();
$pdf->AddPage();

# Cabeçalho
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, utf8_decode('Relatório de usuários cadastrados'), 0, 0,'C');
$pdf->Ln(15);

# Tabela
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 7, 'Nome', 1, 0, "C");
$pdf->Cell(70, 7, 'E-mail', 1, 0, "C");
$pdf->Cell(45, 7, 'Perfil', 1, 0, "C");
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
foreach($usuarios->selecionarTodos() as $key => $value) {
	$pdf->Cell(60, 7, utf8_encode($value->nome), 1, 0, "C");
	$pdf->Cell(70, 7, $value->email, 1, 0, "C");
	$pdf->Cell(45, 7, $perfis->buscarPerfil($value->id_perfil), 1, 0, "C");
	$pdf->Ln();
}

$pdf->Output();
?>