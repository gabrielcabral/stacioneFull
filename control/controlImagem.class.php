<?php
// iniciar_sessao
session_start();

// carregar as classes dinamicamente
require_once 'autoload.php';

// função para resolver problema de header
ob_start();

// define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle do funcionario
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlImagem extends ControlGeral
{

    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public 
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultar() 
    {

        $objImagem = new ModelImagem();
        return $listaImagem = $objImagem->consultar();
    }

    
    /**
     * Método utilizado para chamar a funçãi
     * @access public
     * @param String $Imagem
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirImagem($strImagem) 
    {

        // invocar métódo  e passar parâmetros
        $objFuncionario = new ModelImagem();

        // se for válido invocar o método de iserir
        if ($objFuncionario->inserirImagem($strImagem) == true) {
            // se for inserido com sucesso mostrar a mensagem
            //$_SESSION['msg'] = "Inserido com sucesso!";
            // redirecionar
            header("location: ../view/modulo.php?modulo=entrada&menu=inserir");
        } else {
            $_SESSION['msg'] = "Erro na Camera!";
            // redirecionar
            header("location: ../view/modulo.php?modulo=principal");
        }
    }

}
