<?php
//error_reporting(~E_ALL & E_NOTICE & ~E_WARNING);
// carrega as classes automaticamente
require_once 'autoload.php';
// verifica qual modulo e qual e qual menu é o escolhido
$modulo = $_GET["modulo"];
$menu = $_GET["menu"];
switch ($modulo) {
    // modulo cliefuncionarionte
    case 'funcionario':
        switch ($menu) {
            // menu consultar
            case 'consultar':
                include 'consultarFuncionario.php';
                break;
            // menu inserir
            case 'inserir':
                include 'inserirFuncionario.php';
                break;
            // menu alterar
            case 'alterar':
                include 'alterarFuncionario.php';
                break;
            // menu alterarSenha
            case 'alterarSenha':
                include 'alterarPassoword.php';
                break;
        }
        break;
    // modulo usuario
    case 'veiculo':
        switch ($menu) {
            // menu consultar
            case 'consultar':
                include 'consultarVeiculo.php';
                break;
            // menu inserir
            case 'inserir':
                include 'inserirVeiculo.php';
                break;
        }
        break;
    // modulo vagas
    case 'vaga':
        switch ($menu) {
            // menu alterar
            case 'alterar':
                include 'vagas.php';
                break;
        }
        break;
    case 'entrada':
        switch ($menu) {
            // menu inserir
            case 'inserir':
                include 'inserirEntrada.php';
                break;
        }
        break;
    case 'saida':
        switch ($menu) {
            // menu inserir
            case 'sair':
                include 'efetuarPagamento.php';
                break;
        }
        break;
    case 'preco':
        switch ($menu) {
            // menu inserir
            case 'alterar':
                include 'precos.php';
                break;
        }
        break;
    case 'pagamento':
        switch ($menu) {
            // menu inserir
            case 'efetuar':
                include 'efetuarPagamento.php';
                break;
        }
        break;
    case 'relatorio':
        switch ($menu) {
            // menu consultar
            case 'consultar':
                include 'relatorios.php';
                break;
        }
        break;
    default:
        // menu padrão
        include 'principal.php';
        break;
}
