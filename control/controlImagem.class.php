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
 * Classe de controle de imagem
 * @version 1.0.0
 */
class ControlImagem extends ControlGeral
{

    /**
     * Método utilizado para validar os dados cadastrados e invocar o método consultar no model
     * @access public
     * @return Array dados da imagem
     */
    function consultar()
    {

        $objImagem = new ModelImagem();
        return $listaImagem = $objImagem->consultar();
    }


    /**
     * Método utilizado para e invocar o método inserirImagem no model
     * @access public
     * @param String $strImagem
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
