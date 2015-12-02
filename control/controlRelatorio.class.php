<?php
// iniciar_sessao
//session_start();

// carregar as classes dinamicamente
require_once 'autoload.php';
// carregar as classes para gerar PDF
require '../public/fpdf/fpdf.php';
// função para resolver problema de header
ob_start();

// define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 11/10/2015
 * Classe de relatorio
 * @author Gabriel Cabral  (cabraldealmeida@gmail.com)
 * @version 1.0.0
 */
class ControlRelatorio extends ControlGeral
{

    /**
     * Método utilizado para validar os dados dos pets cadastrados e invocar o método onsultarDados no model
     * @access public 
     * @param Array dados do Relatorio
     * @return Array dados do Relatorio
     */
    function gerarRelatorio($arrdados)
    {

        $objRel = new ModelRelatorio();
        $arrdados['entrada'] = $this->dataAmericano($arrdados['entrada']);
        $arrdados['saida'] = $this->dataAmericano($arrdados['saida']);

        $dados = $objRel->consultarDados($arrdados);
        #gerar o relatório em PDF
        $this->relatorio($dados, $arrdados);
    }

    /**
     * gera o ralatótio em PDF
     * @param $arrdados
     * @param $dados
     * return PDF
     */
    function relatorio($arrdados, $dados)
    {


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('../bootstrap/img/logo.JPG', 75, 10, -300);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(180, 100, 'Stacione', '0', '1', 'C');
        // muda fonte e coloca em negrito
        $pdf->SetFont('Arial', 'B', 10);
        // largura padrão das colunas
        $largura = 80;
        // altura padrão das linhas das colunas
        $altura = 6;
        $pdf->Cell($largura, $altura, 'Data: '.date('d/m/Y', strtotime($dados['entrada'])).' a '.date('d/m/Y', strtotime($dados['saida'])), 0, 0, 'L');
        $pdf->Ln(10);
        // criando os cabeçalhos para 5 colunas
        $pdf->Cell($largura, $altura, 'Data', 1, 0, 'L');
        $pdf->Cell($largura, $altura, 'Total', 1, 0, 'L');
        // pulando a linha
        $pdf->Ln($altura);
        // tirando o negrito
        $pdf->SetFont('Arial', '', 10);
        $total=0;
        foreach($arrdados as $value){
            $totaldiaria = 0;
               $totaldiario = $value[''] * $value['diarias'];
            $pdf->Cell($largura, $altura,  date('d/m/Y', strtotime($value['entrada'])), 1, 0, 'L');
            $pdf->Cell($largura, $altura, 'R$'.$totaldiario, 1, 0, 'C');
            $pdf->Ln($altura);
            $total +=$totaldiario;
        }
        $pdf->Cell($largura, $altura, 'Total', 1, 0, 'L');
        $pdf->Cell($largura, $altura, 'R$'.$total, 1, 0, 'C');
        $pdf->Output('Relatorio_Stacione'.date('dmYHis').'.pdf', 'D');
    }
}
