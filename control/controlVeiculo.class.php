﻿<?php
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
 * Classe de controle do Veiculo
 * @author Gabriel Cabral  (cabraldealmeida@gmail.com)
 * @version 1.0.0
 */
class ControlVeiculo extends ControlGeral
{



    /**
     * Método utilizado para validar os dados dos Veiculos cadastrados e invocar o método consultarVeiculo no model
     * @access public 
     * @param Int    $id   id do Veiculo
     * @param String $nome nome do Veiculo
     * @return Array dados do Veiculo
     */
    function consultar($arrVeiculo = null) 
    {

        $objVeiculo = new ModelVeiculo();
        return $listaVeiculo = $objVeiculo->consultar($arrVeiculo);
    }

    /**
     * Método utilizado para validar os dados dos Veiculos cadastrados e invocar o método consultarVeiculo no model
     * @access public
     * @param Int    $id   id do Veiculo
     * @param String $nome nome do Veiculo
     * @return Array dados do Veiculo
     */
    function consultarVeiculo($int) 
    {

        $objVeiculo = new ModelVeiculo();
        return $listaVeiculo = $objVeiculo->consultarVeiculo($int);
    }

    /**
     * Método utilizado para validar os dados dos Veiculos cadastrados e invocar o método consultarVeiculo no model
     * @access public
     * @param Int    $id   id do Veiculo
     * @param String $nome nome do Veiculo
     * @return Array dados do Veiculo
     */
    function selectFabricante() 
    {

        $objVeiculo = new ModelVeiculo();
        return $listaVeiculo = $objVeiculo->consultaFabricante();
    }

    /**
     * Método utilizado validar os dados dos Veiculos cadastrados e invocar o método inserirVeiculo no model
     * @access public 
     * @param String $nome         nome do Veiculo
     * @param String $cpf          CPF do Veiculo
     * @param String $dtNascimento data de nascimento do Veiculo
     * @param String $telefone     telefone do Veiculo
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserir($dadosVeiculo) 
    {

        // invocar métódo  e passar parâmetros
        $objVeiculo = new ModelVeiculo();

        // se for válido invocar o método de iserir
        if ($objVeiculo->inserirVeiculo($dadosVeiculo) == true) {
            // se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            // redirecionar
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            $_SESSION['tipoMsg'] = 0;
            // redirecionar
            header("location: ../view/modulo.php?modulo=veiculo&menu=inserir");
        }
    }

        /**
         * Método utilizado validar os dados dos Veiculos e invocar o método alterarVeiculo no model
         * @access public
         * @param Array
         * @return Boolean retorna TRUE se os dados forem salvos com sucesso
         */
        function alterar($dadosVeiculo) {

            #invocar métódo  e passar parâmetros
            $objVeiculo = new ModelVeiculo();



            if ($objVeiculo->alterarVeiculo($dadosVeiculo) == true) {
                #se for alterado com sucesso mostrar a mensagem
                $_SESSION['msg'] = "Alterado com sucesso!";
                $_SESSION['tipoMsg'] = 2;
                #redirecionar
                header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
            } else {
                $_SESSION['msg'] = "Erro ao alterar!";
                $_SESSION['tipoMsg'] = 0;
                #redirecionar
                header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
            }
        }



    /**
     * Método utilizado para validar os dados dos Veiculos e invocar o método excluirVeiculo no model
     * @access public
     * @param Int $id id do VEICULO
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function delete($id) 
    {

        // invocar métódo  e passar parâmetros
        $objVeiculo = new ModelVeiculo();

        // invocar métódo  e passar parâmetros
        if ($objVeiculo->excluir($id) == true) {
            // se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            $_SESSION['tipoMsg'] = 0;
            header("location: ../view/modulo.php?modulo=veiculo&menu=consultar");
        }
    }
}
